<?php 

namespace app\database;

class Dbh {
    public \PDO $pdo;

    public function __construct($db_host, $db_name, $db_user, $db_password){
        try{
            $this->pdo = new \PDO("mysql:host=$db_host; dbname=$db_name", $db_user, $db_password);
        } catch (\PDOException $e){
            error_log('PDO Exception at __construct(): ' . $e->getMessage(). "\n-> In File:". $e->getFile(). "\n-> Stacktrace:\n". $e->getTraceAsString());
            die();
        }
    }

    public function dbh_read($query, $params){
        try{
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);

            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);  
            if(count($results) > 0){
                return $results;
            } else {
                return false;
            }
        } catch (\PDOException $e){
            error_log('PDO Exception at dbh_read(): ' . $e->getMessage(). "\n-> In File:". $e->getFile(). "\n-> Stacktrace:\n". $e->getTraceAsString());
            return false;
        } finally {
            $stmt = null;
        }
    }

    public function dbh_write($query, $params){
        try{
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);

            return true;
        } catch (\PDOException $e){
            error_log('PDO Exception at dbh_write(): ' . $e->getMessage(). "\n-> In File:". $e->getFile(). "\n-> Stacktrace:\n". $e->getTraceAsString());
            return false;
        } finally {
            $stmt = null;
        }
    }
}

?>