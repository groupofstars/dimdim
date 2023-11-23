<?php
include "conn.php";

$funcao = $_POST['func'];
$valor = $_POST['orc'];



$pdo->query("INSERT INTO func (funcao, valor, status) VALUES ('$funcao', '$valor', '3')");

echo 1; 

?>