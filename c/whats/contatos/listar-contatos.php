<?php
include "../conn.php";

$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$contatos = $pdo->query("SELECT * FROM leads WHERE owner = '$owner'");

if($contatos->rowCount() > 0){

	foreach($contatos as $key){

		$dados[] = array('id' => $key['id'],
						 'nome' => $key['nome'],
						 'numero' => $key['num'],
						 'email' => $key['email'],
						 'status' => $key['status']);
	}


	echo json_encode($dados);
}else{
	echo 0;
}
?>