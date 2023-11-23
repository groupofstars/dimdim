<?php
include "../../conn.php";

$dados = json_decode(file_get_contents('php://input'),false);

$nome = $dados->nome;
$valor = $dados->valor;
$instancias = $dados->instancias;

$valor = str_replace(',', '.', $valor);

$pdo->query("INSERT INTO planos (nome,valor, instancias, status) VALUES ('$nome', '$valor', '$instancias', '1')");

$id_inserido = $pdo->lastInsertId();

foreach($dados->modulos as $key){
	$modulo = $key->modulo;
	if($modulo == 'whats-listas'){
		foreach($key->lista as $k){
			$envio = $k->mod;
			$status = $k->status;
			if($status == 'true'){
				$pdo->query("INSERT INTO planos_envios (envio, plano) VALUES ('$envio', '$id_inserido')");
			}
		}
	}
	$pdo->query("INSERT INTO planos_modulos (modulo, plano) VALUES ('$modulo', '$id_inserido')");
}

echo 1;

?>