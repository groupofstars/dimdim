<?php
include "conn.php";

$id = $_POST['id'];

$pdo->query("UPDATE func SET status = '0' WHERE id = '$id'");

echo 1;

?>