<?php
include "../conn.php";

$lista = $_POST['lista'];
$contatos = $_POST['contatos'];
$data = $_POST['data'];
$num = $_POST['num'];

$tipo = $pdo->query("SELECT tipo FROM listas_wpp WHERE id = '$lista'")->fetchColumn();

$owner = $pdo->query("SELECT owner FROM listas_wpp WHERE id = '$lista'")->fetchColumn();

$pdo->query("INSERT INTO agendar (lista,lista_contatos, tipo, num, data, status, owner) VALUES ('$lista','$contatos', '$tipo' ,'$num','$data', '0', '$owner')");

echo 1;
?>