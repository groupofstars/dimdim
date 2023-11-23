<?php
include "conn.php";

$id = $_POST['id'];

$listar = $pdo->query("SELECT * FROM listas WHERE id = '$id'");
foreach ($listar as $key) {
	$dados = array('id' => $key['id'],
				   'nome' => $key['nome'],
				   'message' => $key['message']); 
}

echo json_encode($dados);
?>