<?php
include "../../../conn.php";

$dados = $pdo->query("SELECT * FROM all_configs");

foreach($dados as $key){
	$data = array('porcent' => $key['porcentagem_afd']);
}


echo json_encode($data);
?>