<?php
include "../../conn.php";

$credenciais = $pdo->query("SELECT * FROM all_configs");
foreach($credenciais as $key){
	$dados = array('pubkey' => $key['public_key'],
				   'actoken' => $key['access_token']);
}

echo json_encode($dados);
?>