<?php
include "conn.php";

$user = $_POST['user'];

$show = $pdo->query("SELECT * FROM users WHERE id = '$user'");

foreach($show as $k){
	$dados = array('id' => $k['id'],
				   'nome' => $k['nome'],
                   'email' => $k['email'],
                   'senha' => $k['senha'],
				   'cpf' => $k['cpf'],
				   'saldo' => $k['saldo'],
				   'status' => $k['status']);
}

echo json_encode($dados);
?>