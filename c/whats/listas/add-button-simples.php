<?php
include "../conn.php";

$dados  = json_decode(file_get_contents('php://input'), false);


$nome = $dados->nome;
$user = $dados->user;
$title = $dados->title;
$footer = $dados->footer;

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('his')."-send";


$pdo->query("INSERT INTO listas_wpp (nome, owner, tipo, hash) VALUES ('$nome', '$owner', 'button-simples', '$hash')");

$pdo->query("INSERT INTO lista_buttons (lista, title, footer) VALUES ('$hash','$title', '$footer')");

foreach($dados->buttons as $key){
	$button = $key->button;
	if($button != ''){
		$pdo->query("INSERT INTO buttons (hash, botao) VALUES ('$hash', '$button')");
	}
}

echo 1;
/*// Seleciona o primeiro elemento cujo texto é "Exemplo"
var element = document.querySelector("*:contains('Exemplo')");*/



?>

