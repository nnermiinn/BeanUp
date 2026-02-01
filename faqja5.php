<?php
require_once __DIR__ . "/app/core/Auth.php";
require_once __DIR__ . "/app/models/Page.php";
require_once __DIR__ . "/app/models/Coffee.php";
require_once __DIR__ . "/app/models/Barista.php";

Auth::start();
$user = Auth::user();

$pageModel = new Page();
$pageAbout = $pageModel->getContent('about-us');

$coffeeModel = new Coffee();
$coffees = $coffeeModel->getAll();

$baristaModel = new Barista();
$baristas = $baristaModel->getAll();
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BeanUp | Rreth Nesh</title>
    <link rel="stylesheet" href="faqja5.css" />
</head>
<body>

<?php include 'includes/header.php'; ?>

<section class="about-us">
    <h2><?= htmlspecialchars($pageAbout['title'] ?? 'Rreth Nesh') ?></h2>
    <p><?= nl2br(htmlspecialchars($pageAbout['content'] ?? 'BeanUp lindi nga dashuria për kafenë cilësore...')) ?></p>
</section>

<section class="our-coffees">
    <h2>Kafetë tona</h2>
    <div class="coffee-cards">
        <?php foreach($coffees as $coffee): ?>
        <div class="coffee-card">
            <img src="<?= htmlspecialchars($coffee['image']) ?>" alt="<?= htmlspecialchars($coffee['name']) ?>">
            <h3><?= htmlspecialchars($coffee['name']) ?></h3>
            <p><?= htmlspecialchars($coffee['description']) ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="baristas">
    <h2>Baristat Tonë</h2>
    <div class="barista-cards">
        <?php foreach($baristas as $b): ?>
        <div class="barista-card">
            <img src="<?= htmlspecialchars($b['image']) ?>" alt="<?= htmlspecialchars($b['name']) ?>">
            <h3><?= htmlspecialchars($b['name']) ?></h3>
            <p><?= htmlspecialchars($b['description']) ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="location">
    <h2>Ku na gjeni?</h2>
    <p>
        📍 Rruga Qendra 123, pranë parkut kryesor.<br>
        Ejani dhe shijoni një filxhan kafe në një ambient mikpritës.
    </p>
</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
