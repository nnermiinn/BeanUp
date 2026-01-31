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


</body>
</html>
