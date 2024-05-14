<?php 

namespace app\middleware;
use boot\application;

class AuthMiddleware{
    public function handle($token){
        if($token && is_string($token)){
            if(preg_match('/^[-._a-zA-Z0-9]+$/', $token)){
                return $this->checkLoginState($token);
            }
        }
        return ["authenticated" => false];
    }

    protected function checkLoginState($token){
        try {
            $row = application::$app->dbh->dbh_read("SELECT u.email, u.username, u.profile_id, u.token, 
            p.display_name,  p.profile_picture, p.color_scheme, p.profile_pronouns, p.profile_about
            FROM users u LEFT JOIN profiles p ON u.profile_id = p.profile_id 
            WHERE u.token = :token", array(":token" => $token)); 
            if($row && $row[0]["token"] === $token){
                return ["authenticated" => true, "profile_id" => $row[0]["profile_id"], "profile_name" => $row[0]["display_name"], "profile_pronouns" => $row[0]["profile_pronouns"], "profile_about" => $row[0]["profile_about"], "profile_picture" => $row[0]["profile_picture"], "email" => $row[0]["email"], "username" => $row[0]["username"], "color_scheme" => $row[0]["color_scheme"]];
            }
        } catch (PDOException $e){
            error_log('PDO Exception: ' . $e->getMessage());
            return ["authenticated" => false];
        }
    }
}

?>