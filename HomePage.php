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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BeanUp</title>
    <link rel="stylesheet" href="HomePage.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<header>
    <img src="images/BeanUp.png" alt="logo" class="logo">

    <form method="GET" action="HomePage.php">
        <input
            type="text"
            name="q"
            placeholder="Search your coffee..."
            class="search"
            value="<?= htmlspecialchars($search) ?>"
        >
    </form>
</header>


<?php if (empty($products)): ?>
    <p style="text-align:center; margin-top:40px;">
        Asnjë kafe nuk u gjet ☕
    </p>
<?php endif; ?>

<?php foreach ($products as $index => $p): ?>

    <div class="card <?= ($index % 2 === 1) ? 'reverse' : '' ?>">
        <img src="images/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">


        <div class="text">
            <h1><?= htmlspecialchars($p['name']) ?></h1>
            <p><i><?= htmlspecialchars($p['description']) ?></i></p>
            <h2><?= number_format((float)$p['price'], 2) ?>€</h2>
        </div>

       <button class="order-btn">Order</button>

    </div>
<?php endforeach; ?>

<footer>
    <nav>
        <a href="HomePage.php">Home</a>
        <a href="faqja5.php">About us</a>
        <a href="faqja6.php">Contact</a>

        <?php if ($user): ?>
            <a href="LoginPage.php">Login/ Sign up</a>
        <?php endif; ?>
    </nav>
</footer>


</body>
</html> 