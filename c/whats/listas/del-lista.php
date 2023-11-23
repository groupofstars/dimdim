<?php
include "../conn.php";

$lista = $_POST['lista'];

$all = $pdo->query("SELECT * FROM listas_wpp WHERE id = '$lista'");

foreach($all as $k){
	$hash = $k['hash'];
	$tipo = $k['tipo'];

	if($tipo == 'button'){
		$db = $pdo->query("DELETE FROM lista_buttons WHERE lista = '$hash'");
		$db = $pdo->query("DELETE FROM buttons WHERE hash = '$hash'");
	}else if($tipo == 'midia'){
		$db = $pdo->query("DELETE FROM lista_midia WHERE lista = '$hash'");
	}else if($tipo == 'texto'){
		$db = $pdo->query("DELETE FROM mensagem_lista  WHERE lista = '$hash'");
	}else if($tipo == 'midia-button'){
		$db = $pdo->query("DELETE FROM lista_midia_button WHERE hash = '$hash'");
		$db = $pdo->query("DELETE FROM buttons WHERE hash = '$hash'");
	}else if($tipo == 'lista'){
		$db = $pdo->query("DELETE FROM lista_lista WHERE hash = '$hash'");
		$db = $pdo->query("DELETE FROM row_list WHERE hash = '$hash'");
	}
}

$del = $pdo->query("DELETE FROM listas_wpp WHERE id = '$lista'");
$leads = $pdo->query("DELETE FROM leads WHERE lista = '$lista'");


echo 1;

?>