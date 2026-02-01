<?php

class Database{
    private static $pdo = null;


    public static function pdo() {
        if(self::$pdo===null){
            $host="localhost";
            $db="BeanUp";
            $user="root";
            $pass="";
            $charset="utf8mb4";

            $dns= "mysql:host=$host;dbname=$db;charset=$charset";

            try {
                self::$pdo = new PDO(
                    $dsn,
                    $user,
                    $pass,
                [
                 PDO::ATTR_ERRMODE              =>PDO::ERRMODE_EXCEPTION,

                 PDO::ATTR_DEFAULT_FETCH_MODE   =>PDO::FETCH_ASSOC
                ]
            );
                
            }catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        
         return self::$pdo;
    }
}