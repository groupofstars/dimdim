<?php
include "../conn.php";

$user = $_POST['user'];
$id = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$listar = $pdo->query("SELECT * FROM nums WHERE owner = '$id'");

if($listar->rowCount() > 0){
	foreach ($listar as $key) {
		$num = $key['num'];
		$hoje = date('Y-m-d');
		$vencimento = $pdo->query("SELECT * FROM mensalidades WHERE user = '$id' AND status = '0' AND data < '$hoje'");

		if($vencimento->rowCount() > 0){
			$status = 2;
		}else{
			$status = $key['status'];
		}
		
		$planos = $pdo->query("SELECT * FROM myplan WHERE instance = '$num'");
		if($planos->rowCount() > 0){
			$plano = true;
		}else{
			$plano = false;
		}
		$dados[] = array('id' => $key['id'],
						 'nome' => $key['nome'],
					     'hash' => $key['num'],
					     'status' => $status,
					     'planos' => $plano); 
	}

	echo json_encode($dados);
}else{
	echo 0;
}
?>