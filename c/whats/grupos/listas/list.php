<?php
include "../../conn.php";

$user = $_POST['user'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$listas = $pdo->query("SELECT * FROM listas_save_contatos WHERE user = '$owner' ORDER BY id DESC");

if($listas->rowCount() > 0){
	foreach($listas as $k){
		$dados[] = array('id' => $k['id'],
						 'nome' => $k['nome']);
	}

	echo json_encode($dados);
}else{
	echo 0;
}
?>