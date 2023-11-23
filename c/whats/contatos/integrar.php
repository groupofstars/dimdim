<?php
include "../conn.php";

$instance = $_POST['instance'];
$mensagem = $_POST['mensagem'];
$lista = $_POST['lista'];

if (isset($_FILES['imagem'])) {
	
	$imagem = date('dmy').$_FILES['imagem']['name'];
	move_uploaded_file($_FILES['imagem']['tmp_name'], '../images/'.$imagem);

}else{
	$imagem = null;
}

$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 5).date('dmyhis');

$pdo->query("INSERT INTO integracao (instance, hash, mensagem, imagem, lista)  VALUES ('$instance', '$hash', '$mensagem', '$imagem', '$lista')");

echo 1;
?>