<?php
include "../conn.php";

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$contato = $_POST['contato'];
$user = $_POST['user'];

$owner = $pdo->query("SELECT id  FROM users WHERE email = '$user'")->fetchColumn();

$pdo->query("INSERT INTO funcionarios (nome, email, senha, contato, owner) VALUES ('$nome', '$email', '$senha', '$contato', '$owner')");

echo 1;
?>