<?php 

namespace app\controller;
use app\models\ProfileModel;
use app\middleware\AuthMiddleware;

class SiteController extends BaseController {
    private AuthMiddleware $auth;

    public function __construct(){
        $this->auth = new AuthMiddleware();
    }

    public function renderHome(){
        $AuthUser = $this->auth->handle($_COOKIE["token"] ?? null);
        $this->settitle("home");
        return $this->render("home", [], $AuthUser);
    }
}

?>