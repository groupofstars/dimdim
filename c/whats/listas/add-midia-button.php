<?php
include "../conn.php";

$dados = json_decode(file_get_contents("php://input"), false);

$nome = $dados->nome;
$user = $dados->user;

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();


$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('dmyhis')."-send".$owner;

$add =  $pdo->query("INSERT INTO listas_wpp (nome, owner, tipo, hash) VALUES ('$nome', '$owner', 'midia-button', '$hash')");


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

$pdo->query("INSERT INTO lista_midia_button (image,type, assunto, footer, hash) VALUES ('$imgname', '$type', '$assunto', '$footer', '$hash')");


$btns = $dados->buttons;

foreach($btns as $k){
	$button = $k->button;

	$pdo->query("INSERT INTO buttons (hash, botao) VALUES ('$hash', '$button')");
}

echo 1;

?>