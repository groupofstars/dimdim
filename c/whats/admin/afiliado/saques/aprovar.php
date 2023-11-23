<?php
include "../../../conn.php";
$id = $_POST['id'];

$owner = $pdo->query("SELECT user FROM solicita_saque WHERE id = '$id'")->fetchColumn();

$saque = $pdo->query("SELECT valor FROM solicita_saque WHERE id = '$id'")->fetchColumn();

$saldo = $pdo->query("SELECT saldo_afiliado FROM users WHERE id = '$owner'")->fetchColumn();

$novo = $saldo-$saque; 

$pdo->query("UPDATE users SET saldo_afiliado = '$novo' WHERE id = '$owner'");
$pdo->query("UPDATE solicita_saque SET status = '2' WHERE id = '$id'");

echo 1;
?>