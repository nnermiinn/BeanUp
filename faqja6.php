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
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kontakti</title>
    <link rel="stylesheet" href="faqja6.css" />
</head>

<body>

<header class="header">
    <h1>BeanUp</h1>
    <p>Kafene e Vogël, Aromë e Madhe ☕</p>
</header>

<section class="container">

    <div class="info-grid">

        <div class="info-box">
            <h3>📞 Nr Telefonit</h3>
            <p>044-876-452</p>
        </div>

    <div class="info-box">
            <h3>📲 WhatsApp</h3>
            <p>+383-44-876-452</p>
    </div>

    <div class="info-box">
            <h3>✉️ Email</h3>
            <p>filan@festeku.com</p>
    </div>

    <div class="info-box">
            <h3>🍵 Kafja jonë</h3>
            <p>📍 Rruga Qendra 123, pranë parkut kryesor</p>
    </div>

    <div class="info-image">
            <img src="images/vendi.jpg" alt="Foto e vendit">
    </div>

</div>

<div class="form-box">
    <h2>Na Kontakto</h2>

    <form method="POST" action="faqja6.php" novalidate>

            <div class="form-group">
                <label>Emri *</label>
                <input type="text" name="full_name" placeholder="Emri juaj" required value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>">
            </div>

<div class="form-group">
        <label>Email *</label>
        <input type="email" name="email" placeholder="Emaila jote" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
</div>

<div class="form-group">
        <label>Produkti</label>
        <input type="text" name="product" placeholder="Produkti juaj" value="<?= htmlspecialchars($_POST['product'] ?? '') ?>">
</div>

<div class="form-group">
        <label>Koment *</label>
        <textarea name="message" placeholder="Shkruani komentin..." required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
</div>

<button class="btn" type="submit">Dërgo</button>

        <?php if ($error): ?>
            <p style="color:red; margin-top:15px;">
            <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p style="color:green; margin-top:15px;">
                <?= htmlspecialchars($success) ?>
            </p>
        <?php endif; ?>

        </form>
    </div>

</section>

<footer>

</body>
</html>
