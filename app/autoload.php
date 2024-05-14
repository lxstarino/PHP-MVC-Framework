<?php 
    spl_autoload_register('AutoLoader');

    function AutoLoader($className) {
        $extension = ".classes.php";
        $URI = $_SERVER['REQUEST_URI'];


        $path = strpos($URI, "includes") !== false ? '../../' : '../';
        
        //echo $path . str_replace("\\", DIRECTORY_SEPARATOR, $className) . $extension. "<br>";
        if(!file_exists($path . str_replace("\\", DIRECTORY_SEPARATOR, $className) . $extension)){
            die("Error - Please try again later"); 
        }

        include_once $path . str_replace("\\", DIRECTORY_SEPARATOR, $className) . $extension;
    }
?>