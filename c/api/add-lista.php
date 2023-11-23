<?php
include "conn.php";

$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();
$nome = $_POST['nome'];
$assunto = $_POST['assunto'];
$message = $_POST['message'];


$insere = $pdo->query("INSERT INTO listas (nome, assunto, message, owner) VALUES ('$nome', '$assunto', '$message', '$owner')");
echo 1;

?>