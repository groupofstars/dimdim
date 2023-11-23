<?php
include "../conn.php";

$lista = $_POST['lista'];

$contatos = $pdo->query("SELECT * FROM leads WHERE lista = '$lista'");

foreach($contatos as $c){
	$cts[] = array('num' => $c['num']);
}

$tipo = $pdo->query("SELECT tipo FROM listas_wpp WHERE id = '$lista'")->fetchColumn();

$dados = array('tipo'=> $tipo,
				 'contatos' => $cts);
echo json_encode($dados);
?>