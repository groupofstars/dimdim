<?php
include "../conn.php";

$id = $_POST['id'];

$pdo->query("DELETE FROM leads WHERE id = '$id'");

echo 1;
?>