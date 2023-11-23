<?php
include "../conn.php";

$user = $_POST['user'];

$show = $pdo->query("SELECT * FROM users WHERE id = '$user'");

$bloqueados = $pdo->query("SELECT * FROM modulos_block WHERE user = '$user'");
foreach($bloqueados as $key){
	$modulos_block[] = array($key['modulo']);
}
foreach($show as $k){
	$dados = array('id' => $k['id'],
				   'nome' => $k['nome'],
                   'email' => $k['email'],
                   'senha' => $k['senha'],
				   'cpf' => $k['cpf'],
				   'expira' => $k['expira'],
				   'instancias' => $k['instancias'],
				   'block' => $modulos_block);
}

echo json_encode($dados);
?>