<?php
include "../conn.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$numero = $_POST['numero'];
$email = $_POST['email'];
$status = $_POST['status'];


$pdo->query("UPDATE leads SET nome = '$nome', num = '$numero', email = '$email', status = '$status' WHERE id = '$id'");

echo 1;
?>