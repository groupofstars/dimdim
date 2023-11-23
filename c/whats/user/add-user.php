<?php
include "../conn.php";

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$plano = $_POST['plano'];

$numeros = $_POST['numeros'];



if($plano != 2){
	$creditos = 0;
}else {
	$creditos = @$_POST['creditos'];
}

if($plano != 1){
	$vencimento = date('Y-m-d');
}else{
	$vencimento = @$_POST['vencimento'];
}

$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$token = substr(str_shuffle($string), 0, 3)."-".date('dmyhis');


$add = $pdo->query("INSERT INTO users (nome, email, senha, plano, nums_liberado, msg_liberada, vencimento, token, nivel) VALUES ('$nome', '$email', '$senha', '$plano', '$numeros', '$creditos', '$vencimento', '$token', '0')");

echo 1;


?>