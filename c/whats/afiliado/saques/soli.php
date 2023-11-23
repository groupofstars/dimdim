<?php
include "../../conn.php";

$user = $_POST['user'];
$saque = number_format($_POST['saque'], 2, '.', '');
$conta = $_POST['conta'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$verifica = $pdo->query("SELECT saldo_afiliado FROM users WHERE id = '$owner'")->fetchColumn();

$total_saque = $pdo->query("SELECT SUM(valor) FROM solicita_saque WHERE user = '$owner' AND  status = '1'")->fetchColumn();

$verifica = $verifica - $total_saque;

if($conta != 'undefined'){
	$hoje = date('Y-m-d h:i:s');
	if($verifica >= $saque){
		$pdo->query("INSERT INTO solicita_saque (user, valor, conta, status, data) VALUES ('$owner', '$saque', '$conta', '1', '$hoje')");

		echo 1;

		//echo $hoje;
	}else{
		echo 0;
		echo $verifica." - ".$saque;
	}
}else{
	echo 2;
}
?>