<?php
include "../conn.php";


$id = $_POST['id'];
$nome = $_POST['nome'];
$valor = $_POST['valor'];

$pdo->query("INSERT INTO functions (id_item, nome, valor,status) VALUES ('$id','$nome', '$valor', '1')");

echo 1; 
?>