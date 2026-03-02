<?php
require_once "config.php";

$ime = trim($_POST["ime"] ?? "");
$prezime = trim($_POST["prezime"] ?? "");
$email = trim($_POST["email"] ?? "");

if ($ime === "" || $prezime === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  die("Neispravan unos. Vrati se nazad.");
}

$stmt = $pdo->prepare("INSERT INTO users (ime, prezime, email) VALUES (?, ?, ?)");
$stmt->execute([$ime, $prezime, $email]);

header("Location: index.php");
exit;