<?php
include "../conn.php";

$id = $_POST['id'];

$del = $pdo->query("DELETE FROM agendar WHERE id = '$id'");
echo 1;
?>