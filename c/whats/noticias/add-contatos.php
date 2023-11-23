<?php
include "../conn.php";

$lista = $_POST['lista'];
$num = $_POST['num'];

$hash = $pdo->query("SELECT grupo FROM  noticias WHERE id = '$lista'")->fetchColumn();

$add = $pdo->query("INSERT INTO leads_noticia (id_contato, id_lista, grupo) VALUES ('$num', '$lista', '$hash')");

echo 1; 
?>