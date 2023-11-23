<?php
include "../conn.php";

$dados = json_decode(file_get_contents("php://input"), false);

$pergunta = $dados->pergunta;
$num = $dados->num;


$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('his')."-reply".$num;

$pdo->query("INSERT INTO reply (pergunta, responde, num, hash) VALUES ('$pergunta', 'midia-button', '$num', '$hash')");




$assunto = $dados->assunto;
$footer = $dados->footer;
$image = $dados->file;
$type = $dados->type;
$imgname = $dados->imgname;


$image = str_replace('data:'.$type.';base64,', '', $image);
$image = str_replace(' ', '+', $image);
$data_img = base64_decode($image);

$file = '../images/'.$imgname;
$move = file_put_contents($file, $data_img);


$pdo->query("INSERT INTO reply_midia_button (image,type, assunto, footer, hash) VALUES ('$imgname', '$type', '$assunto', '$footer', '$hash')");


$btns = $dados->buttons;

foreach($btns as $k){
	$button = $k->button;

	$pdo->query("INSERT INTO buttons (hash, botao) VALUES ('$hash', '$button')");
}

echo 1;
?>