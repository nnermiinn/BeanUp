<?php

require __DIR__ . "/app/core/Database.php";
require __DIR__ . "/app/core/Auth.php";

Auth::start();
$user = Auth::user();

$pdo = Database::pdo();

$search = trim($_GET['q'] ?? '');

if ($search !== '') {
    $stmt = $pdo->prepare(
        "SELECT * FROM products
        WHERE name LIKE ? OR description LIKE ?
        ORDER BY id DESC"
    );

    $stmt->execute(["%$search%", "%$search%"]);
    
} else {
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
}

$products = $stmt->fetchAll();
?>