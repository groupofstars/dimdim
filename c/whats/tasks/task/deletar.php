<?php
include "../../conn.php";

$id = $_POST['id'];

$pdo->query("DELETE FROM itens_task WHERE id = '$id'");
$pdo->query("DELETE FROM list_task WHERE id = '$id'");

echo 1;
?>