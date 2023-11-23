<?php
include "../../../conn.php";

$id = $_POST['id'];

$listar = $pdo->query("SELECT * FROM modulos WHERE curso = '$id' ORDER BY id ASC");

if($listar->rowCount() > 0){
	foreach($listar as $k){
		$id_modulo = $k['id'];

		$dados[] = array('id' => $k['id'],
						 'nome' => $k['nome']);
	}

	echo json_encode($dados);
}else{
	echo 0;
}

?>