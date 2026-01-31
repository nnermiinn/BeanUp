<?php
require __DIR__ . "/app/core/Auth.php";
Auth::start();

$user = Auth::user();
?>
<nav>
  <a href="HomePage.php">Home</a>
  <a href="faqja5.php">About us</a>
  <a href="faqja6.php">Contact</a>

  <?php if ($user): ?>
    <a href="LoginPage.php">Login / Sign up</a>
  <?php endif; ?>
</nav>