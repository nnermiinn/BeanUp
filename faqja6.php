<?php

require __DIR__ . "/app/core/Database.php";
require __DIR__ . "/app/core/Auth.php";

Auth::start();

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $product = trim($_POST['product'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message === '') {
        $error = "Plotëso fushat e detyrueshme.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email jo valid.";
    } else {
        $pdo = Database::pdo();

        $stmt = $pdo->prepare(
            "INSERT INTO contact_messages (full_name, email, product, message)
            VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$name, $email, $product, $message]);

    $success = "Mesazhi u dërgua me sukses. Faleminderit!";

    }
}
