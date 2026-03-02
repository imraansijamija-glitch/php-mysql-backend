<?php
require_once "config.php";

$stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

header("Content-Type: application/json");
echo json_encode($users);