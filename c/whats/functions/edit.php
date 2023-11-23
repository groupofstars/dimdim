<?php
include "../conn.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$valor = $_POST['valor'];

$valor = str_replace(',', '.', $valor);

$pdo->query("UPDATE functions SET nome = '$nome', valor = '$valor' WHERE id = '$id'");
?>