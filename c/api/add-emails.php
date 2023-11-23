<?php
include "conn.php";

$user = $_POST['user'];
$lista = $_POST['lista'];
$email = $_POST['email'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();
$insere = $pdo->query("INSERT INTO emails (email, lista, owner) VALUES ('$email', '$lista', '$owner')");

echo 1;
?>