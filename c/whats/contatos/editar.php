<?php
include "../conn.php";

$id = $_POST['id'];
$instance = $_POST['instance'];
$mensagem = $_POST['mensagem'];

$pdo->query("UPDATE integracao SET instance = '$instance', mensagem = '$mensagem' WHERE lista = '$id'");

echo 1; 
?>