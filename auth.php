<?php
class Auth{
    public static function start(){
        if (session status() === PHP_SESSION_NONE)
            session_start();
    }
    public static function user(){
        self::start();
        return$_SESSION['user'] ?? null;
    }
    public static function login($userRow){
        self::start();
        $_SESSION['user']=[
            'id'=>$userRow['id'],
            'name'=>$userRow['name'],
            'surname'=>$userRow['surname'],
            'email'=>$userRow['email'],
            'role'=>$userRow['role']
        ];
    }
    public static function logout(){
        self::start();
        session_destroy();
    }
    public static function requireLogin(){
        self::start();
        if(!isset($_SESSION['user'])){
         header("Location:LoginPage.php");
         exit;
        }
    }
    public static function requireAdmin(){
        self::requireLogin();
        if(($_SESSION['user']['role']??'')!=='admin'){
            header("Location:HomePage.php")
            exit;
        }
    }
}