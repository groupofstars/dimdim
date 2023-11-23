<?php
include "../conn.php";

$id = $_POST['id'];

$pdo->query("UPDATE users SET status = '2' WHERE id = '$id'");

echo 1;

?>