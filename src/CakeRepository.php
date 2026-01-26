<?php

require_once __DIR__ . "/Database.php";

class CakeRepository
{
    public function all(): array
    {
        $db = Database::get();
        $stmt = $db->query("SELECT * FROM cakes ORDER BY id");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}