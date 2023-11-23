<?php
include "../conn.php";

$user = $_POST['user'];
$cep = $_POST['cep'];
$endereco = $_POST['endereco'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];

$id = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$pdo->query("DELETE FROM dados_config WHERE user = '$id'");

$pdo->query("INSERT INTO dados_config (user, cep, endereco, numero, bairro, cidade, estado) VALUES ('$id', '$cep', '$endereco','$numero', '$bairro', '$cidade', '$estado')");

echo 1;
?>