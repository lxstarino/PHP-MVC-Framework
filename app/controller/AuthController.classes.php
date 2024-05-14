<?php 

namespace app\controller;

use app\models\LoginModel;
use app\middleware\AuthMiddleware;

class AuthController extends BaseController {
    private AuthMiddleware $auth;

    public function __construct(){
        $this->auth = new AuthMiddleware();
        $this->setlayout("auth");
    }

    public function renderLogin()
    {
        if($this->auth->handle($_COOKIE["token"] ?? null)["authenticated"]){
            header("location: /");
            exit();
        }
        $this->settitle("sign in");
        return $this->render("login");
    }

    public function handleLogin(){
        if($this->auth->handle($_COOKIE["token"] ?? null)["authenticated"]){
            header("location: /");
            exit();
        }
        $this->settitle("sign in");

        $uid = htmlspecialchars(trim($_POST["uid"]), ENT_QUOTES, 'UTF-8');
        $pwd = htmlspecialchars(trim($_POST["pwd"]), ENT_QUOTES, 'UTF-8');

        $LoginModel = new LoginModel($uid, $pwd);
        if($LoginModel->validate()){
            if($LoginModel->login()){
                header("location: /");
                exit();
            }
        } 
        $page_params = [ "errors" => $LoginModel->errors, "uid" => $uid ];
        return $this->render("login", $page_params);
    }
}

?>
