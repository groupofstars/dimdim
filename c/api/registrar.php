<?php
include "conn.php";

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$cpf = $_POST['cpf'];
$celular = @$_POST['celular'];



$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".date('dmyhis');


$cpf_first = explode('.', $cpf)[0].substr(str_shuffle($string), 0, 2);;
$first = substr(str_shuffle($string), 0, 3);
$token = substr(str_shuffle($string), 0, 5)."-".$first."-".$cpf_first;



	$hoje = date('Y-m-d');
	$dias = $pdo->query("SELECT dias_free FROM all_configs")->fetchColumn();
	$exp = date('Y-m-d', strtotime("+$dias days", strtotime($hoje)));


$verifica = $pdo->query("SELECT * FROM users WHERE email = '$email' OR cpf = '$cpf'");

if($verifica->rowCount() > 0){
	echo 0;
}else{
	
	$pdo->query("INSERT INTO users (nome, email,image,contato, senha, cpf, status, expira,plano, nivel, instancias, token) VALUES ('$nome', '$email', 'default.png','$celular','$senha','$cpf', '1', '$exp', '0', '0', '1', '$token')");

	echo 1;
}
?>