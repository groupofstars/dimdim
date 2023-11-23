<?php
include "../conn.php";
$id = $_POST['id'];
$pdo->query("DELETE FROM functions WHERE id = '$id'");
echo 1;
?>