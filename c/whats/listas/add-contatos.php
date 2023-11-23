<?php
include "../conn.php";

$lista = $_POST['lista'];
$num = $_POST['num'];

$owner = $pdo->query("SELECT owner FROM lista_contatos WHERE id = '$lista'")->fetchColumn();

$add = $pdo->query("INSERT INTO leads (lista, num, owner, status) VALUES ('$lista', '$num', '$owner', 'verificado')");

echo 1; 
?>