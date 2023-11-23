<?php 
include "../conn.php";

$id = $_POST['id'];

$pdo->query("DELETE FROM enc_url WHERE id = '$id'");

echo 1;
?>