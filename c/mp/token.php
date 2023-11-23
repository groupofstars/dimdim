<?php
include "../whats/conn.php";

$dados = $pdo->query("SELECT * FROM all_configs");
foreach($dados as $key){
	$data = array('token' => $key['access_token'],
				  'key' => $key['public_key']);
}

echo json_encode($data);
?>