<?php
include "../../../conn.php";

$id = $_POST['id'];

$aula = $pdo->query("SELECT * FROM  aulas WHERE id = '$id'");

foreach($aula as $k){
	$dados = array('nome' => $k['aula'],
				   'link' => $k['link']);
}

echo json_encode($dados);
?>