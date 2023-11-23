<?php
include "../conn.php";

$dados = json_decode(file_get_contents("php://input"), false);

$pergunta = $dados->pergunta;
$num = $dados->num;

$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('his')."-reply".$num;



$pdo->query("INSERT INTO reply (pergunta, responde, num, hash) VALUES ('$pergunta', 'lista', '$num', '$hash')");


$title = $dados->title;
$texto = $dados->text;
$desc = $dados->desc;
$button =  $dados->button;

$pdo->query("INSERT INTO reply_lista (title, texto, description, button, hash) VALUES ('$title', '$texto', '$desc', '$button', '$hash')");

$rows = $dados->rows;


foreach($rows as $k){
	$title = $k->title;
	$desc = $k->desc;
	$id = $k->id;

	$pdo->query("INSERT INTO row_list (title, description, identifica, hash) VALUES ('$title', '$desc', '$id', '$hash')");

}

echo 1;

?>