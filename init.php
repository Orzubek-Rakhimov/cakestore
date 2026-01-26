<!-- docker compose exec php php init.php-->
<?php

$db = new PDO("sqlite:db/cakestore.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("
  CREATE TABLE IF NOT EXISTS cakes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    price REAL NOT NULL,
    description TEXT
  )
");

$count = $db->query("SELECT COUNT(*) FROM cakes")->fetchColumn();

if ($count == 0) {
    $db->exec("
    INSERT INTO cakes (name, price, description) VALUES
    ('Chocolate Cake', 15.99, 'Rich chocolate sponge'),
    ('Vanilla Cake', 12.99, 'Classic vanilla flavor'),
    ('Red Velvet', 18.50, 'Cream cheese frosting')
  ");
}

echo "Databaza Tayyor ✅";