<?php
include "../conn.php";

$user = $_POST['user'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$listar = $pdo->query("SELECT * FROM nums WHERE status = '1' AND owner = '$owner'");

if($listar->rowCount() > 0){
	foreach($listar as $key){
		$instancia = $key['num'];
		$bot = $pdo->query("SELECT count(id) FROM chatbot WHERE instancia = '$instancia'")->fetchColumn();

		$dados[] = array('id' => $key['id'],
						 'nome' => $key['nome'],
						 'num' => $key['num'],
						 'bot' => $bot);
	}

	echo json_encode($dados);
}else{
	echo 0;
}
?>