<?php
include "../conn.php";

$id = $_POST['id'];

$pdo->query("UPDATE users SET status = '1' WHERE id = '$id'");

echo 1;

?>