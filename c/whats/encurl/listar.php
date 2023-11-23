<?php
include "../conn.php";

$user = $_POST['user'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$listar = $pdo->query("SELECT * FROM enc_url WHERE owner = '$owner'");

if($listar->rowCount() > 0){
	foreach($listar as $key){
		$dados[] = array('id' => $key['id'],
						 'url' => $key['url'],
						 'enc' => $key['enc'],
						 'cliques' => $key['cliques']);
	}

	echo json_encode($dados);
}else{
	echo 0;
}

?>