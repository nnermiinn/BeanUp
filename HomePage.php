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

$products = [
    ['name' => 'Espresso', 'description' => '100% kafe e grimcuar, ujë i nxehtë', 'price' => 1.50, 'image' => 'espresso.png'],
    ['name' => 'Macchiato', 'description' => '1 shot espresso + pak shkumë qumështi', 'price' => 1.80, 'image' => 'macchiato.png'],
    ['name' => 'Americano', 'description' => '1 shot espresso + 100+150 ml ujë i nxehtë', 'price' => 2.00, 'image' => 'americano.png'],
    ['name' => 'Iced Coffee', 'description' => '1 shot espresso + ujë i ftohtë + akull + qumësht', 'price' => 2.50, 'image' => 'iced coffee.png'],
    ['name' => 'Cappuccino', 'description' => '1 shot espresso + 100 ml qumësht i avulluar + shkumë qumështi', 'price' => 2.50, 'image' => 'cappuccino.png'],
    ['name' => 'Ristretto', 'description' => '1 shot espresso e përqendruar (më e fortë se espresso)', 'price' => 1.70, 'image' => 'ristretto.png'],
    ['name' => 'Mocha', 'description' => '1 shot espresso + 150+200 ml qumësht i avulluar + çokollatë + shkumë qumështi', 'price' => 3.00, 'image' => 'mocha.png'],
    ['name' => 'Latte', 'description' => '1 shot espresso + 200 ml qumësht i avulluar + pak shkumë qumështi', 'price' => 2.70, 'image' => 'latte.png'],
    ['name' => 'Affogato', 'description' => '1 shot espresso mbi akullore vanilje', 'price' => 3.50, 'image' => 'affogato.png'],
    ['name' => 'Float White', 'description' => '1 shot espresso + 150+200 ml qumësht i avulluar + pak shkumë qumështi', 'price' => 2.80, 'image' => 'float white.png'],
];
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