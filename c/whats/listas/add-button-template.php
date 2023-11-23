<?php
include "../conn.php";

$dados  = json_decode(file_get_contents('php://input'), false);

$nome = $dados->nome;
$user = $dados->user;
$title = $dados->title;
$footer = $dados->footer;


$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('his')."-send".$num;


$pdo->query("INSERT INTO listas_wpp (nome, owner, tipo, hash) VALUES ('$nome', '$owner', 'button-template', '$hash')");

$pdo->query("INSERT INTO lista_buttons (lista, title, footer) VALUES ('$hash','$title', '$footer')");

$buttons = $dados->buttons;

foreach($buttons as $key){
	$button = $key->button;
	$type = $key->type;
	$payload = $key->payload;


	$pdo->query("INSERT INTO buttons_template (button, type, payload, hash) VALUES ('$button','$type', '$payload', '$hash')");
}  


echo 1;
?>