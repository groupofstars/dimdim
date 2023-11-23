<?php
include "conn.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$message = $_POST['message'];

$edit = $pdo->query("UPDATE listas SET nome = '$nome', message = '$message' WHERE  id = '$id'");
echo 1;
?>
