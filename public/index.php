<?php

require_once __DIR__ . "/../src/CakeRepository.php";

$repo = new CakeRepository();
$cakes = $repo->all();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cake Store</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
<h1>🎂 Cake Store</h1>

<div class="cakes">
    <?php foreach ($cakes as $cake): ?>
        <div class="cake">
            <h2><?= htmlspecialchars($cake['name']) ?></h2>
            <p><?= htmlspecialchars($cake['description']) ?></p>
            <span>$<?= number_format($cake['price'], 2) ?></span>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>