<?php 

include_once dirname(__DIR__). "/app/autoload.php";

use boot\Application;
use app\controller\SiteController;
use app\controller\AuthController;
use app\controller\ProfileController;

$pathEnv = dirname(__DIR__). "/.env";

if(file_exists($pathEnv)){
    $readEnv = parse_ini_file($pathEnv);

    foreach ($readEnv as $key => $value) {
        $_ENV[$key] = $value;
    }
}

$app = new Application(dirname(__DIR__));

$app->router->get("/", [SiteController::class, "renderHome"]);
$app->router->get("/sign-in", [AuthController::class, "renderLogin"]);
$app->router->post("/sign-in", [AuthController::class, "handleLogin"]);


$app->run();

?>