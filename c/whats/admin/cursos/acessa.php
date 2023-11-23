<?php
include "../../conn.php";

$id = $_POST['id'];

$curso = $pdo->query("SELECT * FROM cursos WHERE id = '$id'");
$modulos = $pdo->query("SELECT * FROM modulos WHERE curso = '$id'");

foreach($modulos as $m){

	$cont[] = array('id' => $m['id'],
					'modulo' => $m['nome']);

}

foreach($curso as $c){


	$dados = array('nome' => $c['nome'],
				   'desc' => $c['descricao'],
				   'cont' => $cont);
}


echo json_encode($dados);

?>