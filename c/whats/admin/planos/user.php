<?php
include "../../conn.php";

$user = $_POST['user'];
$check = $pdo->query("SELECT plano FROM users WHERE email = '$user'")->fetchColumn();

if($check > 0){
	$tipo = 'faturas';

}else{
	$tipo = 'planos';
	$planos = $pdo->query("SELECT * FROM planos WHERE status = '1'");
	foreach($planos as $key){
		$id = $key['id'];
		$modulos = $pdo->query("SELECT modulo FROM planos_modulos WHERE plano = '$id'")->fetchAll();

		$modulos_sem_indice = array_column($modulos, 'modulo');
		
		$dados[] = array('id' => $key['id'],
						 'nome' => $key['nome'],
						 'valor' => $key['valor'],
						 'instancias' => $key['instancias'],
						 'modulos' => $modulos_sem_indice);
	}

	
}

echo json_encode(array('tipo' => $tipo, 'dados' => $dados));
?>