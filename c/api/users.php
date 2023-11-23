<?php
include "conn.php";

$users = $pdo->query("SELECT * FROM users WHERE nivel = '0' ORDER BY id DESC");

if($users->rowCount() > 0){

	foreach($users as $k){
		$dados[] =  array('id' => $k['id'],
						  'nome' => $k['nome'],
						  'email' => $k['email'],
						  'cpf' => $k['cpf'],
						  'saldo' => $k['saldo'],
						  'status' => $k['status']);
	}

	echo json_encode($dados);
}else{
	echo 0;
}
?>