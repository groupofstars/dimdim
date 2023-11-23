<?php
include "conn.php";

$id = $_POST['id'];

$deleta = $pdo->query("DELETE FROM listas WHERE id = '$id'");
$deleta = $pdo->query("DELETE FROM emails WHERE lista = '$id'");
echo 1;
?>