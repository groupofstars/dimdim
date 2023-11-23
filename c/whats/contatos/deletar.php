<?php
include "../conn.php";
$lista = $_POST['id'];

$pdo->query("DELETE FROM integracao WHERE lista = '$lista'");
$pdo->query("DELETE FROM leads WHERE lista = '$lista'");
$pdo->query("DELETE FROM lista_contatos WHERE id = '$lista'");

echo 1;
?>