<?php
include "../../conn.php";

$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$contas = $pdo->query("SELECT * FROM contas_bancarias WHERE owner = '$owner'");

$saldo = $pdo->query("SELECT saldo_afiliado FROM users WHERE  id = '$owner'")->fetchColumn();

$saques_solicitado = $pdo->query("SELECT SUM(valor) FROM solicita_saque WHERE user = '$owner' AND status = '1'")->fetchColumn();

$disponivel = $saldo - $saques_solicitado;


if($contas->rowCount() > 0){
	foreach($contas as $key){
		$contas_dados[] = array('id' => $key['id'],
							  'nome' => $key['nome'],
							  'pix' => $key['pix']);
	} 

	$dados = array('contas' => $contas_dados,
				   'saldo' => $disponivel);

	echo json_encode($dados);
}else{
	echo 0;
}
?>