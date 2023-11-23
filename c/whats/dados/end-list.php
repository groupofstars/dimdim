<?php
include "../conn.php";

$user = $_POST['user'];

$id = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$end = $pdo->query("SELECT * FROM dados_config WHERE user = '$id'");

if($end->rowCount() > 0){
	foreach($end as $key){
		$dados = array('cep' => $key['cep'],
					   'endereco' => $key['endereco'],
					   'numero' => $key['numero'],
					   'bairro' => $key['bairro'],
					   'cidade' => $key['cidade'],
					   'estado' => $key['estado']);
	}

	echo json_encode($dados);
}else {
	echo 0;
}

?>