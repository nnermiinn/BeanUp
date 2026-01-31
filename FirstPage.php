<?php

require __DIR__ . "/app/core/Auth.php";
Auth::start();

$user = Auth::user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BeanUp</title>
  <link rel="stylesheet" href="FirstPage.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

  <div class="container">
    <img src="images/BeanUp.png" alt="logo" class="logo">
  </div>

  <div>
    <h1>
      <i>"Welcome to BeanUp. Your perfect cup starts here"</i>

      <?php if ($user): ?>
        <a href="HomePage.php">Continue</a>
      <?php else: ?>
        <a href="LoginPage.php">Continue</a>
      <?php endif; ?>
    </h1>
  </div>

</body>
</html>