<?php
include "../../conn.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$desc = $_POST['desc'];

$imagem = $pdo->query("SELECT foto FROM cursos WHERE id = '$id'")->fetchColumn();

if($_FILES){

	$midia = date('dmy').$_FILES['midia']['name'];
	unlink("images/".$imagem);
	move_uploaded_file($_FILES['midia']['tmp_name'], 'images/'.$midia);
}else{
	$midia = $imagem;
}

$pdo->query("UPDATE cursos SET nome = '$nome', descricao = '$desc', foto = '$midia' WHERE id = '$id'");

echo 1;
?>