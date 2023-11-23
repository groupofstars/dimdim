<?php
include "../../conn.php";

$user = $_POST['user'];
$nome = $_POST['nome'];
$chave = $_POST['chave'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$pdo->query("INSERT INTO contas_bancarias (nome, pix, owner) VALUES ('$nome', '$chave', '$owner')");

echo 1;
?>