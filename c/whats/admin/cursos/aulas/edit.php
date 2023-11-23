<?php
include "../../../conn.php";

$id = $_POST['id'];
$aula = $_POST['nome'];
$link = $_POST['link'];

$pdo->query("UPDATE  aulas SET aula = '$aula', link = '$link' WHERE id = '$id'");

$modulo = $pdo->query("SELECT modulo FROM aulas WHERE id = '$id'")->fetchColumn();

echo $modulo;
?>