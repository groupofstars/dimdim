<?php
include "../../conn.php";

$nome = $_POST['nome'];
$desc = $_POST['desc'];

$midia = date('dmy').$_FILES['midia']['name'];

move_uploaded_file($_FILES['midia']['tmp_name'], 'images/'.$midia);


$pdo->query("INSERT INTO cursos (nome, descricao, foto) VALUES ('$nome', '$desc', '$midia')");

echo 1;
?>