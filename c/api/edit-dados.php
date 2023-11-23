<?php 
include "conn.php";

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$cpf = $_POST['cpf'];

$edit = $pdo->query("UPDATE users SET nome = '$nome', email = '$email', senha = '$senha' WHERE cpf = '$cpf'");

echo 1;
?>