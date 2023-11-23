<?php
include "../../../conn.php";

$nome = $_POST['nome'];
$curso = $_POST['id'];

$pdo->query("INSERT INTO modulos (curso, nome) VALUES ('$curso', '$nome')");

echo 1;

?>