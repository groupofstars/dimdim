<?php
include "../../conn.php";

$id = $_POST['id'];

$curso = $pdo->query("SELECT * FROM cursos WHERE id = '$id'");

foreach($curso as $key){
	$dados = array('nome' => $key['nome'],
				   'desc' => $key['descricao'],
				   'imagem' => $key['foto']);

}

echo json_encode($dados);
?>