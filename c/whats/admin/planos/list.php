<?php
include "../../conn.php";

$listar = $pdo->query("SELECT * FROM planos ORDER BY id");

if($listar->rowCount() > 0){
	foreach($listar as $key){
		$valor = "R$ " . number_format($key['valor'], 2, ',', '.');
		$dados[] = array('id' => $key['id'],
						 'nome' => $key['nome'],
						 'valor' => $valor,
						 'status' => $key['status']);
	}
	echo json_encode($dados);
}else{
	echo 0;
}
?>