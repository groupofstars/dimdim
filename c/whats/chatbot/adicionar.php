<?php
include "../conn.php";

$instancia_id = $_POST['instance'];
$keys = $_POST['keys'];

$instancia = $pdo->query("SELECT num FROM nums WHERE id = '$instancia_id'")->fetchColumn();

$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".date('dmyhis');

$token = substr(str_shuffle($string), 0, 10).uniqid();

$keys_all = str_replace('-', ', ', $keys);

$pdo->query("INSERT INTO chatbot (instancia, pergunta, hash) VALUES ('$instancia', '$keys_all', '$token')");

$keys = explode("-", $keys);


foreach($keys as $key){
	//$key = strtolower($key);

	$pdo->query("INSERT INTO chatbot_perguntas (instancia, pergunta, hash) VALUES ('$instancia', '$key', '$token')");
}

echo 1;
?>