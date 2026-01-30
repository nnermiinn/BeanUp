<?php
require_DIR_."/app/core/database.php";
require_DIR_."/app/core/auth.php";
auth::start();
$error=;
if ($_SERVER['REQUEST_METHOD']=='POST'){
  $email=trim($_POST['email']??'');
  $password=$_POST['password']??'';
    if($email==='' || $password===''){
      $error="Plotëso të gjitha fushat.";
  
    }
      else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $error="Email jo valide.";
    }
      else{
        $pdo=Database::pdo();
        $stmt=$pdo->prepare("SELECT*FROM users WHERE email =?");
        $stmt->execute([$email]);
        $user=$stmt->fetch();
    if(!$user || !password_verify($password,$user['password hash'])){
      $error="Email ose password gabim.";
    }else{
        auth::login($user);
        
    if ($user['role']==='admin') {
       header("Location: dashboard/index.php");
    } else {
       header("Location: home.php");
       }
       exit;

      }
   }
}