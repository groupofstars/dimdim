<?php
include "../../conn.php";

$list = $pdo->query("SELECT * FROM cursos ORDER BY id desc");

if($list->rowCount() > 0){

	foreach($list as $key){

		$id = $key['id'];
		$modulos = $pdo->query("SELECT count(id) FROM modulos WHERE curso = '$id'")->fetchColumn();

		$dados[] = array('id' => $key['id'],
						 'foto' => $key['foto'],
						 'nome' => $key['nome'],
						 'desc' => $key['descricao'],
						 'modulos' => $modulos);
	}

	echo json_encode($dados);

}else{	
	echo 0;
}

?>