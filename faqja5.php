<?php

require __DIR__ . "/app/core/Auth.php";
Auth::start();

$user = Auth::user();
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>BeanUp | Rreth Nesh</title>
    <link rel="stylesheet" href="faqja5.css" />
</head>

<body>

<header class="header">
    <h1>BeanUp</h1>
    <p>Kafene e Vogël, Aromë e Madhe ☕</p>

    <?php if ($user): ?>
        <p style="margin-top:10px;">
            Mirë se erdhe, <?= htmlspecialchars($user['name']) ?> 👋
        </p>
    <?php else: ?>
        <p style="margin-top:10px;">
            <a href="LoginPage.php" style="color:#503225; font-weight:bold;">
                Login
            </a>
        </p>
    <?php endif; ?>
</header>

<section class="about-us">
    <h2>Rreth Nesh</h2>
    <p>
        BeanUp lindi nga dashuria për kafenë cilësore dhe ambientet e ngrohta.
        Çdo filxhan përgatitet me përkushtim, duke sjellë shije autentike dhe
        eksperiencë unike për çdo klient.
    </p>
</section>

<section class="values">
    <h2>Pse BeanUp?</h2>
        <div class="values-container">
        <div class="value-card">
    <h3>☕ Kafe Cilësore</h3>
        <p>Kokrrat tona përzgjidhen me kujdes nga ferma të njohura.</p>
    </div>

</body>
</html>
