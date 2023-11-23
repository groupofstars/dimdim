<?php
include "../../../conn.php";

$id = $_POST['id'];
$nome = $_POST['nome'];


$pdo->query("UPDATE modulos SET nome = '$nome' WHERE id = '$id'");
$curso = $pdo->query("SELECT curso FROM modulos WHERE id = '$id'")->fetchColumn();

echo $curso;
?>