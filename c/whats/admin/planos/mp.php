<?php
include "../../conn.php";

$tipo = $_POST['tipo'];

if($tipo == 'list'){
	$list = $pdo->query("SELECT * FROM all_configs");
	foreach($list as $key){
		$dados = array('pubkey' => $key['public_key'],
					   'actoken' => $key['access_token']);
	}

	echo json_encode($dados);
}else if($tipo == 'update'){
	$pubkey = $_POST['pubkey'];
	$actoken = $_POST['actoken'];

	$pdo->query("UPDATE all_configs SET public_key = '$pubkey', access_token = '$actoken'");

	echo 1;
}

?>