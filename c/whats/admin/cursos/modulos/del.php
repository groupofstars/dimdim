<?php
include "../../../conn.php";

$id = $_POST['id'];

$pdo->query("DELETE FROM modulos WHERE id = '$id'");
$pdo->query("DELETE FROM aulas WHERE modulo = '$id'");

echo 1;
?>