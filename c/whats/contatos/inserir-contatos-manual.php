<?php
include "../conn.php";

$dados  = json_decode(file_get_contents('php://input'), false);

$user = $dados->user;
$owner = $pdo->query("SELECT id FROM users WHERE  email = '$user'")->fetchColumn();

$lista = $dados->lista;

$contatos = $dados->contatos;
foreach ($contatos as $key => $value) {
	//$contato  = explode(' ', $value);
	//@$nome = $contato[0]; 
	@$numero = $value; 
	//@$email = $contato[2];

	$pdo->query("INSERT INTO leads (lista, nome, num, email, owner, status) VALUES ('$lista', '', '$numero', '', '$owner', 'erro')");
}

echo 1;


?>