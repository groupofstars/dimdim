<?php

include "conn.php";

$email = $_POST['email'];
$msg = @$_POST['msg'];
$title = @$_POST['title'];
$cliente = $_POST['cliente'];
$hoje = date('Y-m-d');
$lista = $_POST['lista'];

$senha = $pdo->query("SELECT senha FROM contas WHERE email = '$email'")->fetchColumn();
$id_email = $pdo->query("SELECT id FROM contas WHERE email = '$email'")->fetchColumn();
$owner = $pdo->query("SELECT owner FROM contas WHERE email = '$email'")->fetchColumn();
$msg = $pdo->query("SELECT message FROM listas WHERE id = '$lista'")->fetchColumn();
$assunto = $pdo->query("SELECT assunto FROM listas WHERE id = '$lista'")->fetchColumn();

$verify = $pdo->query("SELECT count(id) FROM envios WHERE email = '$id_email' AND data = '$hoje'")->fetchColumn();


if($verify >= 500){
	$dados = array('status'=> 0,
				   'email' => $email,
				   'cliente' => $cliente,
				   'erro' => 'Limite excedido');
	echo json_encode($dados);

}else if($verify < 500 ){
	include "../../envia.php";
}



?>