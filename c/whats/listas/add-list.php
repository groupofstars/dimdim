<?php
include "../conn.php";

$dados = json_decode(file_get_contents("php://input"), false);



$nome = $dados->nome;
$user = $dados->user;

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();


$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('dmyhis')."-send".$owner;

$add =  $pdo->query("INSERT INTO listas_wpp (nome, owner, tipo, hash) VALUES ('$nome', '$owner', 'lista', '$hash')");

$title = $dados->title;
$texto = $dados->text;
$desc = $dados->desc;
$button = $dados->button;


$insere = $pdo->query("INSERT INTO lista_lista (title, texto, description, button, hash) VALUES ('$title', '$texto', '$desc', '$button', '$hash')");


$rows = $dados->rows;

foreach($rows as $key){
	$title = $key->title;
	$desc = $key->desc;
	$id = $key->id;

	$pdo->query("INSERT INTO row_list (title, description, identifica, hash) VALUES ('$title', '$desc', '$id', '$hash')");
}


echo 1;



?>