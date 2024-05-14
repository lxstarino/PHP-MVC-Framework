<?php

namespace app\helpers;

class Rules {
    const RULE_REQUIRED = "required";
    const RULE_MAX = "max";
    const RULE_MIN = "min";
    const RULE_EMAIL = "email";
    const RULE_USERNAME = "username";
    const RULE_MATCH = "match";

    public array $errors = [];

    public function rules(){
        return [];
    }

    public function validate(){
        foreach($this->rules() as $attr => $rules){
            $value = $this->{$attr} ?? $attr;
            foreach($rules as $key => $val){
                // [self::RULE_REQUIRED]
                if($val == self::RULE_REQUIRED && !$value){
                    $this->errors[$attr. "-required"] = "$attr field is required";
                }
                
                // [self::RULE_MIN] => 3
                if($key == self::RULE_MIN && strlen($value) < $val){
                    $this->errors[$attr.  "-min"] = "$attr must be atleast $val characters long";
                }

                // [self::RULE_MAX] => 16
                if($key == self::RULE_MAX && strlen($value) > $val){
                    $this->errors[$attr.  "-max"] = "$attr must be less than $val characters";
                }

                // [self::RULE_EMAIL]
                if($val == self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
                    $this->errors[$attr.  "-validation"] = "Invalid $attr";
                }

                // [self::RULE_USERNAME]
                if($val == self::RULE_USERNAME && !preg_match("/^[a-zA-Z0-9]*$/", $value)){
                    $this->errors[$attr.  "-validation"] = "Invalid $attr";
                }

                // [self::RULE_MATCH] => "repeatedPwd"
                if($key == self::RULE_MATCH && $value !== $val){
                    $this->errors[$attr.  "-match"] = "$attr doesn't match";
                }
            }
        }
        return empty($this->errors);
    }
}

?>