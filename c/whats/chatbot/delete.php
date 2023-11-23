<?php
include "../conn.php";

$id = $_POST['id'];

$instancia = $pdo->query("SELECT num FROM nums WHERE id = '$id'")->fetchColumn();

$pdo->query("DELETE FROM chatbot WHERE instancia = '$instancia'");
$pdo->query("DELETE FROM chatbot_perguntas WHERE instancia = '$instancia'");
$pdo->query("DELETE FROM chatbot_responde WHERE instancia = '$instancia'");

echo 1;
?>