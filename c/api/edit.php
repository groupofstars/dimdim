<?php
include "conn.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];
$status = $_POST['status'];
$saldo = $_POST['saldo'];

$add = $pdo->query("UPDATE users SET nome='$nome', email='$email', senha='$senha', cpf='$cpf',status='$status', saldo='$saldo' WHERE id = '$id'");

echo 1;
?>