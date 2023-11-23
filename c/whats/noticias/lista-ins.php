<?php
include "../conn.php";

$key = $_POST['key'];

$listas = $pdo->query("SELECT * FROM noticias WHERE num = '$key'");

if($listas->rowCount() > 0){
	foreach($listas as $k){
		$dados[] = array('id' => $k['id'],
						 'nome' => $k['nome']);
	}
	echo json_encode($dados);
}else{
	echo 0;
}
?>