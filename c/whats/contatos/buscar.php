<?php
include "../conn.php";

$id = $_POST['id'];

$dados = $pdo->query("SELECT * FROM integracao WHERE lista = '$id'");

if($dados->rowCount() > 0){

	foreach($dados as $key){
		$data = array('instance' => $key['instance'],
					  'mensagem' => $key['mensagem']);
	}

	echo json_encode($data);
}else{
	echo 0;
}

?>