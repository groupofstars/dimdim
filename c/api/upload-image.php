<?php
header('Content-Type: application/json');
include "conn.php";

$user =  $_POST['user'];
$id = $pdo->query("SELECT id  FROM users WHERE email = '$user'")->fetchColumn();


if(!empty($_FILES['imagem'])){
	$imagem = date('dmYhis').time().".png";
	move_uploaded_file($_FILES['imagem']['tmp_name'], '../../images/'.$imagem);
	
	$insere = $pdo->query("INSERT INTO images (nome, user) VALUES ('$imagem', '$id')");

	echo 1;
}else{
	echo "erro";
}

?>