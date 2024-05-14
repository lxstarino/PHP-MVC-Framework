<?php 

namespace app;

class Response {
    public function setStatusCode($code){
        return http_response_code($code);
    }

    public function redirect($url){
        return header("location: $url");
    }
}

?>