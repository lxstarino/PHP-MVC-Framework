<?php 

namespace boot;

use app\Router;
use app\Response;
use app\controller\BaseController;
use app\database\Dbh;



class Application {
    public static string $ROOT_DIR;
    public static $app;
    public ?BaseController $basecontroller = null;
    public Router $router;
    public Response $response;
    public Dbh $dbh;

    public function __construct($rootPath){
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        $this->response = new Response();
        $this->router = new Router($this->response);
        $this->dbh = new Dbh($_ENV["db_host"], $_ENV["db_name"], $_ENV["db_user"], $_ENV["db_password"]);
    }

    public function run(){
        echo $this->router->resolve();
    }
}

?>