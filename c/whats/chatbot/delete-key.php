<?php
include "../conn.php";

$id = $_POST['id'];

$all = $pdo->query("SELECT * FROM chatbot WHERE id = '$id'");
foreach($all as $key){
	$instancia = $key['instancia'];
	$hash = $key['hash'];
}

$pdo->query("DELETE FROM chatbot WHERE hash = '$hash'");
$pdo->query("DELETE FROM chatbot_perguntas WHERE hash = '$hash'");
$pdo->query("DELETE FROM chatbot_responde WHERE hash = '$hash'");

$instancia_id = $pdo->query("SELECT id FROM nums WHERE num = '$instancia'")->fetchColumn();

echo $instancia_id;
?>