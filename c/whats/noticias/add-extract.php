<?php
include "../conn.php";

$numero = $_POST['num'];
$lista = $_POST['lista'];


$grupo = $pdo->query("SELECT grupo FROM noticias WHERE id = '$lista'")->fetchColumn();

$pdo->query("INSERT INTO leads_noticia (id_contato, id_lista, grupo) VALUES ('$numero', '$lista', '$grupo')");


?>