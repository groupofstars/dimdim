<?php
include "../conn.php";

$lista = $_POST['lista'];

$contatos = $pdo->query("SELECT * FROM leads WHERE lista = '$lista'");

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