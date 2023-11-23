<?php
include "../conn.php";
$lista = $_POST['id'];

$l = $pdo->query("SELECT grupo FROM noticias WHERE id = '$lista'")->fetchColumn();

$leads = $pdo->query("DELETE FROM leads_noticia WHERE id_lista = '$lista'");
$d = $pdo->query("DELETE FROM listas_noticia WHERE grupo = '$l'");
$dd = $pdo->query("DELETE FROM noticias WHERE id = '$lista'");

echo 1;

?>