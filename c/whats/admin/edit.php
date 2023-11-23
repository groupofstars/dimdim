<?php

include "../conn.php";


$dados = json_decode(file_get_contents('php://input'), false);

$id = $dados->id;
$nome = $dados->nome;
$email = $dados->email;
$cpf = $dados->cpf;
$senha =$dados->senha;

$exp = $dados->expira;
$instancias = $dados->instancia;

$pdo->query("UPDATE users SET nome = '$nome', email = '$email', cpf = '$cpf', senha = '$senha', expira = '$exp', instancias = '$instancias' WHERE id = '$id'");



foreach ($dados->mod as $key) {
		$modulo = $key->modulo;
		$on = $key->on;

		
		if($on == 'true'){
			//echo "modulo: $modulo deleta<br>";
			$pdo->query("DELETE FROM modulos_block WHERE modulo = '$modulo' AND user = '$id'");
		}else if($on == 'false'){

			//echo "modulo: $modulo bloqueia<br>";
			$pdo->query("INSERT INTO modulos_block (user, modulo) VALUES ('$id', '$modulo')");
		}
	}
	


echo 1;

?>
