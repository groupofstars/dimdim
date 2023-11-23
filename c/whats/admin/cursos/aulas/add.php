<?php

include "../../../conn.php";

$dados = json_decode(file_get_contents('php://input'), false);

$modulo = $dados->modulo;
$curso = $pdo->query("SELECT curso FROM modulos WHERE id = '$modulo'")->fetchColumn();

foreach($dados->aulas as $k){
	$aula = $k->nome;
	$link = $k->link;
	
	$pdo->query("INSERT INTO aulas (aula, link, modulo, curso) VALUES ('$aula', '$link', '$modulo', '$curso')");
}

echo 1;

?>