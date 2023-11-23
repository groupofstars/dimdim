<?php
include "conn.php";

$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo = $_POST['tipo'];
$em = $_POST['owner'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$em'")->fetchColumn();

$add = $pdo->query("INSERT INTO contas (email, senha, tipo, owner) VALUES ('$email', '$senha', '$tipo', '$owner')");
echo 1;
?>