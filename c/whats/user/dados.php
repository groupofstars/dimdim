<?php
include "../conn.php";

$user = $_POST['user'];

$d = $pdo->query("SELECT * FROM users WHERE email = '$user'");

$iduser = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$blocked = $pdo->query("SELECT * FROM modulos_block WHERE user = '$iduser'");
	foreach($blocked as $key){
		$blocks[] = array($key['modulo']);
	} 

foreach ($d as $key) {
	$id = $key['id'];

	

	$leads = $pdo->query("SELECT count(id) FROM leads WHERE owner = '$id'")->fetchColumn();

	$listas = $pdo->query("SELECT count(id) FROM listas WHERE owner = '$id'")->fetchColumn();

	$envios = $pdo->query("SELECT count(id) FROM envios WHERE user = '$id'")->fetchColumn();

	

	$nums = $pdo->query("SELECT count(id) FROM nums WHERE owner = '$id'")->fetchColumn();

	$data_unix = strtotime($key['expira']);
		$diferenca_segundos = $data_unix - time();
		$diferenca_dias = round($diferenca_segundos / 86400);
		
		if ($diferenca_dias < 0) {
    		$vence = "vencido";
		} elseif ($diferenca_dias <= 3) {
		    $vence = "quase";
		} else {
		   $vence = "emdia";
		}

	$dados = array('nome' => $key['nome'],
				   'email' => $key['email'],
				   'senha' => $key['senha'],
				   'leads' => $leads,
				   'listas' => $listas,
				   'envios' => $envios,
				   'vence' => $vence,
				   'instancias' => $key['instancias'],
				   'nums' => $nums,
				   'nivel' => $key['nivel'],
				   'blocks' => $blocks,
				   'token' => $key['token']);
}

echo json_encode($dados);
?>