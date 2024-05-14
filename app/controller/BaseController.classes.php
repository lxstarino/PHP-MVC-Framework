<?php

namespace app\controller;
use boot\application;

class BaseController {
    public string $layout = "main";
    public string $title = "urtitle";

    public function setlayout($layout){
        $this->layout = $layout;
    }

    public function settitle($title){
        $this->title = $title;
    }

    public function render($view, $page_params = [], $layout_params = []){
        return application::$app->router->renderView($view, $page_params, $layout_params);
    }
}

?>