<?php
class Database{
    private static $pdo=null;


    public static function pdo(){
        if(self::$pdo===null){
            $host="localhost";
            $db="BeanUp";
            $user="root";
            $pass="";
            $charset="utf8mb4";

            $dns=
            "mysql:host=$host;dbname=$db;charset=$charset";
            $options=[
                 PDO::ATTR_ERRMODE=>    PDO::ERRMODE_EXCEPTION,

                 PDO::ATTR_DEFAULT_FETCH_MODE=>   PDO::FETCH_ASSOC
            ];
            self::$pdo=new PDO($dsn,$user,$pass,$options);
        }
         return self::$pdo;
    }
}