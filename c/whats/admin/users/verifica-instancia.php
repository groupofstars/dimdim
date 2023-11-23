<?php
include "../../conn.php";

$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();


$verifica = $pdo->query("SELECT instancias FROM  users WHERE email = '$user'")->fetchColumn();

$criadas = $pdo->query("SELECT * FROM nums WHERE owner = '$owner'")->fetchAll();

$criadas = count($criadas);

if($verifica > $criadas){
	$hoje = date('Y-m-d');
	$em_dia = $pdo->query("SELECT * FROM mensalidades WHERE data < '$hoje' AND status = '0' AND user = '$owner'");
	
	if($em_dia->rowCount() > 0){
		echo 0;
	}else{

	$valor = $pdo->query("SELECT valor FROM functions WHERE id_item = 'instance'")->fetchColumn();
	$dados = array('status' => true,
				   'valor' => $valor);

	echo json_encode($dados);
	}
}else{
	echo 0;
}
?>