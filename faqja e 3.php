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
