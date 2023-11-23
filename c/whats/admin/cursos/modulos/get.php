<?php
include "../../../conn.php";

$id = $_POST['id'];

$modulo = $pdo->query("SELECT nome FROM modulos WHERE id = '$id'")->fetchColumn();

echo $modulo;

?>