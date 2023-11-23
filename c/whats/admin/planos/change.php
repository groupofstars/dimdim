<?php
include "../../conn.php";

$id = $_POST['id'];
$status = $_POST['status'];

$pdo->query("UPDATE planos SET status = '$status' WHERE id = '$id'");
echo 1; 
?>