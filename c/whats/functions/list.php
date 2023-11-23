<?php
include "../conn.php";

$listar = $pdo->query("SELECT * FROM functions  ORDER BY id");

foreach($listar as $key){
	$dados[] = array('id' => $key['id'],
					 'id_item' => $key['id_item'],
					 'nome' => $key['nome'],
					 'valor' => $key['valor'],
					 'status' => $key['status']);
}

echo json_encode($dados);


?>