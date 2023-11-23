<?php
include "../conn.php";
$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM  users WHERE email = '$user'")->fetchColumn();

$listas = $pdo->query("SELECT * FROM lista_contatos WHERE owner = '$owner'");

if($listas->rowCount() > 0){
	foreach($listas as $key){
		$lista = $key['id'];
		$contatos = $pdo->query("SELECT count(id) FROM leads WHERE lista = '$lista'")->fetchColumn();
		$url = $pdo->query("SELECT hash FROM integracao WHERE lista = '$lista'")->fetchColumn();

		$dados[] = array('id' => $key['id'],
						 'nome' => $key['nome'],
						 'contatos' => $contatos,
						 'url' => $url);
	}

	echo json_encode($dados);
}else{
	echo 0;
}

?>