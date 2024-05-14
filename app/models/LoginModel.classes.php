<?php 
    namespace app\models;
    use boot\application;
    use app\helpers\Rules;

    class LoginModel extends Rules {
        public function __construct($uid, $pwd){
            $this->username = $uid;
            $this->password = $pwd;
        }

        public function rules(){
            return [
                "username" => [self::RULE_REQUIRED],
                "password" => [self::RULE_REQUIRED],
            ];
        }

        public function login(){
            $user = application::$app->dbh->dbh_read("SELECT * FROM users where username = :uid OR email = :email;",
            array(":uid" => $this->username, ":email" => $this->username));
            
            if($user === false || !password_verify($this->password, $user[0]["password"])){
                $this->errors["credentials"] = "Invalid Credentials";
                return false;
            }
            
            setcookie("token", $user[0]["token"], time()+500000, "/");
            return true;
        }
    }
?>