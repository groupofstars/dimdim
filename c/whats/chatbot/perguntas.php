<?php
include "../conn.php";

$id = $_POST['instancia'];
$instancia = $pdo->query("SELECT num FROM nums WHERE id = '$id'")->fetchColumn();

$listar = $pdo->query("SELECT * FROM chatbot WHERE instancia = '$instancia'");

if($listar->rowCount() > 0){
	foreach($listar as $key){
		$i = $key['instancia'];
		$hash = $key['hash'];
		$p = $key['pergunta']; 

		$bots = $pdo->query("SELECT count(*) FROM chatbot_responde WHERE instancia = '$i' AND hash = '$hash'")->fetchColumn();

		$dados[] = array('id' => $key['id'],
						 'pergunta' => $p,
						 'bots' => $bots);
	}

	echo json_encode($dados);
}else{
	echo 0;
}
?>