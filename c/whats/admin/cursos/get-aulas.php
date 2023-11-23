<?php
include "../../conn.php";
$id = $_POST['id'];

$aulas = $pdo->query("SELECT * FROM aulas WHERE modulo = '$id'");

if($aulas->rowCount() > 0){
	foreach($aulas as $k){
		$dados[] = array('id' => $k['id'],
						 'nome' => $k['aula'],
					 	 'link' => $k['link']);
		}

	echo json_encode($dados);
}else{
	echo 0;
}



?>