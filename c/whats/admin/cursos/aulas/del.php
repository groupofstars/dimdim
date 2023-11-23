<?php

include "../../../conn.php";

$id = $_POST['id'];

$modulo = $pdo->query("SELECT modulo FROM aulas WHERE id = '$id'")->fetchColumn();
$pdo->query("DELETE FROM aulas WHERE id = '$id'");


echo $modulo;
?>