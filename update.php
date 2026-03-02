<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  exit("Method not allowed");
}

$id = (int)($_POST["id"] ?? 0);
$ime = trim($_POST["ime"] ?? "");
$prezime = trim($_POST["prezime"] ?? "");
$email = trim($_POST["email"] ?? "");

if ($id <= 0) exit("Neispravan ID.");
if ($ime === "" || $prezime === "") exit("Ime i prezime su obavezni.");
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) exit("Email nije validan.");

$stmt = $pdo->prepare("UPDATE users SET ime=?, prezime=?, email=? WHERE id=?");
$stmt->execute([$ime, $prezime, $email, $id]);

header("Location: index.php");
exit;