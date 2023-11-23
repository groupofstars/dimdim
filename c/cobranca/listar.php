<?php
include "../whats/conn.php";

$cobrancas = $pdo->query("SELECT * FROM pagamentos WHERE tipo = '2'");


if($cobrancas->rowCount() > 0){
foreach($cobrancas as $k){

	$id = $k['user'];
	$cliente = $pdo->query("SELECT nome FROM users WHERE id = '$id'")->fetchColumn();

	$dados[] = array('cliente' => $cliente,
					 'valor' => $k['valor'],
					 'status' => $k['status'],
					 'data' => $k['data']);
}

echo json_encode($dados);
}else {
	echo 0;
}

?>