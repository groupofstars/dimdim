<?php
include "../conn.php";


$dados = json_decode(file_get_contents('php://input'), false);

$pergunta = $dados->pergunta;
$assunto = $dados->assunto;
$footer = $dados->footer;
$num = $dados->num;



$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('his')."-reply".$num;


$pdo->query("INSERT INTO reply (pergunta, responde, num, hash) VALUES ('$pergunta', 'button-template','$num', '$hash')");

$pdo->query("INSERT INTO reply_button_template (title, footer, hash) VALUES ('$assunto', '$footer', '$hash')");
$buttons = $dados->buttons;

foreach($buttons as $key){
	$button = $key->button;
	$type = $key->type;
	$payload = $key->payload;


	$pdo->query("INSERT INTO buttons_template (button, type, payload, hash) VALUES ('$button','$type', '$payload', '$hash')");
}  

echo 1;



?>