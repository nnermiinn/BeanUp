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
       header("Location: index.php");
    } else {
       header("Location: HomePage.php");
       }
       exit;

      }
   }
}

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="script.js"></script>
    <meta charset="UTF-8">
    <title>BeanUp☕</title>
    <link rel="stylesheet" href="LoginPage.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="background-color: #f6edda;">

    <div class="container">
        <img src="images/BeanUp.png" alt="logo" class="logo">
    </div>

    <div class="switch-buttons">
        <a href="login.php" class="switch active">Login</a>
        <a href="register.php" class="switch">Sign up</a>
    </div>

    <div class="form-box">
        <form method="POST" action="login.php" >
            <input 
                type="email" 
                name="email" 
                placeholder="Email" 
                required value="<?= htmlspecialchars($_POST['email'] ??'') ?>">

            <input 
                type="password" 
                name="password" 
                placeholder="Password" 
                required >

            <button class="submit-btn" type="submit">Login</button>

            <?php if ($error): ?>
                <p style="color:red; text-align:center; margin-top:10px;">
                    <?= htmlspecialchars($error) ?>
                </p>
            <?php endif; ?>
        </form>
    </div>

</body>
</html>
