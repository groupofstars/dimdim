<?php
include "../../conn.php";

$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$listar = $pdo->query("SELECT * FROM mercadopago WHERE owner = '$owner'");

if($listar->rowCount() > 0){
	foreach($listar as $key){
		$dados[] = array('id' => $key['id'],
						 'nome' => $key['nome'],
						 'at' => $key['access_token'],
						 'pk' => $key['pub_key']);
 	
 	}

 	echo json_encode($dados);
}else{
	echo 0;
}
?>