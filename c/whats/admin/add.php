<?php
include "../conn.php";

$dados = json_decode(file_get_contents('php://input'), false);

$nome = $dados->nome;
$email = $dados->email;
$cpf = $dados->cpf;
$senha =$dados->senha;

$exp = $dados->expira;
$instancias = $dados->instancia;


$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".date('dmyhis');


$cpf_first = explode('.', $cpf)[0].substr(str_shuffle($string), 0, 2);;
$first = substr(str_shuffle($string), 0, 3);
$token = substr(str_shuffle($string), 0, 5)."-".$first."-".$cpf_first;


if($exp == ''){
	$hoje = date('Y-m-d');
	$dias = $pdo->query("SELECT dias_free FROM all_configs")->fetchColumn();
	$exp = date('Y-m-d', strtotime("+$dias days", strtotime($hoje)));
}

$verifica = $pdo->query("SELECT * FROM users WHERE email = '$email' OR cpf = '$cpf'");

if($verifica->rowCount() > 0){
	echo 0;
}else{
	
	$pdo->query("INSERT INTO users (nome, email,image, senha, cpf, status, expira, nivel, instancias, token) VALUES ('$nome', '$email', 'default.png','$senha','$cpf', '1', '$exp', '0', '$instancias', '$token')");

	$id_inserido = $pdo->lastInsertId();
	
	foreach ($dados->mod as $key) {
		$modulo = $key->modulo;
		$on = $key->on;

		
		if($on == 'true'){
			//echo "modulo: $modulo deleta<br>";
			$pdo->query("DELETE FROM modulos_block WHERE modulo = '$modulo' AND user = '$id_inserido'");
		}else if($on == 'false'){

			//echo "modulo: $modulo bloqueia<br>";
			$pdo->query("INSERT INTO modulos_block (user, modulo) VALUES ('$id_inserido', '$modulo')");
		}
	}

echo 1;
}

?>