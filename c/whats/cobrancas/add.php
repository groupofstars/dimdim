<?php
include "../conn.php";
$user = $_POST['user'];
$nome = $_POST['nome'];
$mp = $_POST['mp'];
$text = $_POST['text'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$pdo->query("INSERT INTO cobrancas (nome, texto,mercado_pago, owner) VALUES ('$nome', '$text', '$mp', '$owner')");

$id = $pdo->lastInsertId();
?>