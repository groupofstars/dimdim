<?php
include "../whats/conn.php";

$message = $_POST['msg'];
$link = $_POST['link'];
$instancia = $_POST['instancia'];
$status = $_POST['status'];


$pdo->query("UPDATE config_cobranca SET mensagem = '$message', link = '$link', instancia = '$instancia', status = '$status'");

echo 1;

?>