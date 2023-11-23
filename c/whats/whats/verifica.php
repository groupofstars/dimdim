<?php
include "../conn.php";

$hash = $_POST['hash'];
//$num = $pdo->query("SELECT num FROM nums WHERE id = '$id'")->fetchColumn();
$status = $pdo->query("SELECT status FROM nums WHERE num = '$hash'")->fetchColumn();

echo $status;
?>