<?php
$host = "localhost";
$db   = "php_mysql_backend";
$user = "root";
$pass = "";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);
} catch (PDOException $e) {
  die("Greška konekcije: " . $e->getMessage());
}