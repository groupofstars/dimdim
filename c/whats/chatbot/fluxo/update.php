<?php
include "../../conn.php";

$bot = $_POST['bot'];

$hash = $pdo->query("SELECT hash FROM chatbot WHERE id = '$bot'")->fetchColumn();

$id = $_POST['id'];
$posicao = $_POST['posicao'];


$pdo->query("UPDATE chatbot_responde SET posicao = '$posicao' WHERE  id = '$id'");



?>