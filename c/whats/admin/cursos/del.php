<?php
include "../../conn.php";

$id = $_POST['id'];

$curso = $pdo->query("SELECT * FROM cursos WHERE id = '$id'");

if($curso->rowCount() > 0){
	foreach($curso as $k){
		$imagem = $k['foto'];
	}

	unlink("images/".$imagem);
	
	$pdo->query("DELETE  FROM cursos WHERE id = '$id'");



	$aulas = $pdo->query("SELECT * FROM aulas WHERE curso = '$id'");
	$modulos = $pdo->query("SELECT * FROM modulos WHERE curso = '$id'");
	
	if($aulas->rowCount() > 0){
		$pdo->query("DELETE FROM aulas WHERE curso = '$id'");
	}
	if($modulos->rowCount() > 0){
		$pdo->query("DELETE FROM modulos WHERE curso = '$id'");
	}

		
	echo 1;
}




?>