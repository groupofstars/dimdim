<?php
include "../../../conn.php";

$id = $_POST['id'];

$aulas = $pdo->query("SELECT * FROM aulas WHERE modulo = '$id'");

if($aulas->rowCount() > 0){
	foreach($aulas as $key){
		$dados[] = array('id' => $key['id'],
						 'aula' => $key['aula']);
	}

	echo json_encode($dados);
	
}else{
	echo 0;
}

?>