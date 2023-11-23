<?php
include "../conn.php";

$user = $_POST['user'];

$id = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();
$listas = $pdo->query("SELECT * FROM listas_wpp WHERE owner = '$id'");

if($listas->rowCount() > 0){
	foreach($listas as $k){
		$id = $k['id'];

		$contatos = $pdo->query("SELECT count(id) FROM leads WHERE lista = '$id'")->fetchColumn();
		//$envios = $pdo->query("SELECT count(id) FROM envios WHERE lista = '$id'")->fetchColumn();

		$dados[] = array('id' => $k['id'],
						 'nome' => $k['nome'],
						 'tipo' => $k['tipo'],
						 'contatos' => $contatos);
	}

	echo json_encode($dados);
}else{
	echo 0;
}
?>