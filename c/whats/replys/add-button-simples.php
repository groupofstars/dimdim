<?php
include "../conn.php";

$dados  = json_decode(file_get_contents('php://input'), false);


$pergunta = $dados->pergunta;
$num = $dados->num;
$title = $dados->title;
$footer = $dados->footer;

$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('his')."-reply".$num;





$pdo->query("INSERT INTO reply (pergunta, responde, num, hash) VALUES ('$pergunta', 'button', '$num', '$hash')");

$pdo->query("INSERT into reply_button (hash, title, footer) VALUES ('$hash', '$title', '$footer')");

foreach($dados->buttons as $key){
	$button = $key->button;

	$pdo->query("INSERT INTO buttons (hash, botao) VALUES ('$hash', '$button')");
}

echo 1;

?>
