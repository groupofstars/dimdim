<?php
include "../conn.php";

$lista = $_POST['lista'];

$owner = $pdo->query("SELECT owner FROM listas_wpp WHERE id = '$lista'")->fetchColumn();


$leads = $pdo->query("SELECT count(id) FROM leads WHERE lista = '$lista'")->fetchColumn();


if($leads > 0){

	
		$credito = $pdo->query("SELECT saldo FROM users WHERE id = '$owner'")->fetchColumn();

		if($credito >= $leads){
			$dados = array('status' => 'success');
		}else{
			$dados = array('status' => 'erro',
						   'msg' => 'Créditos insuficientes');
		}

}else{
	$dados = array('status' => 'erro',
				   'msg' => 'Nenhum número encontrado');
}




echo json_encode($dados);
?>