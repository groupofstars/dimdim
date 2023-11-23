<?php
include "../conn.php";

$id = $_POST['id'];

$tipo = $pdo->query("SELECT  tipo FROM listas_wpp WHERE id = '$id'")->fetchColumn();

echo $tipo; 
?>