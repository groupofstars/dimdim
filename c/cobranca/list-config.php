<?php
include "../whats/conn.php";

$config = $pdo->query("SELECT * FROM config_cobranca");

foreach($config as $k){
	$dados = array('mensagem' => $k['mensagem'],
				   'link' => $k['link'],
				   'instancia' => $k['instancia'],
				   'status' => $k['status']);
}

echo json_encode($dados);
?>