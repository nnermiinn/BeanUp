<?php

require __DIR__ . "/app/core/Database.php";
require __DIR__ . "/app/core/Auth.php";

Auth::start();
$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $surname = trim($_POST['surname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

if ($name === '' || $surname === '' || $email === '' || $password === '' || $confirm === '') {
    $error = "Plotëso të gjitha fushat.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Email jo valid.";
} elseif (strlen($password) < 6) {
    $error = "Password duhet të ketë minimum 6 karaktere.";
} elseif ($password !== $confirm) {
    $error = "Password nuk përputhen.";
} else {

        $pdo = Database::pdo();

        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);

    if ($check->fetch()) {
        $error = "Ky email ekziston tashmë.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare(
            "INSERT INTO users (name, surname, email, password_hash, role)
            VALUES (?, ?, ?, ?, 'user')"
        );
        $stmt->execute([$name, $surname, $email, $hash]);

        $success = "Regjistrimi u krye me sukses. Mund të kyçesh.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="faqja e 3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="signup-container">
    <h2>SIGN UP</h2>

    <form method="POST" action="faqja e 3.php" novalidate>

        <input type="text" name="name" placeholder="Name" required
            value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">

        <input type="text" name="surname" placeholder="Surname" required
            value="<?= htmlspecialchars($_POST['surname'] ?? '') ?>">

        <input type="email" name="email" placeholder="Email" required
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

        <input type="password" name="password" placeholder="Password" required>

        <input type="password" name="confirm_password" placeholder="Confirm Password" required>

        <button type="submit">Sign Up</button>


        <?php if ($error): ?>
            <p style="color:red; margin-top:10px;">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p style="color:green; margin-top:10px;">
                <?= htmlspecialchars($success) ?>
            </p>
        <?php endif; ?>

    </form>

    <p>
    You have an account?
        <a href="LoginPage.php">Log In</a>
    </p>
</div>

</body>
</html>