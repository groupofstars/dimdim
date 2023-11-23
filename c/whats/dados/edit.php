<?php 
include "../conn.php";

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$cpf = $_POST['cpf'];


$id = $pdo->query("SELECT id FROM users WHERE cpf = '$cpf'")->fetchColumn();

if($_FILES['image']){
	 $directory = 'images/';
 $name = uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
  move_uploaded_file($_FILES['image']['tmp_name'], $directory . $name);


$edit = $pdo->query("UPDATE users SET nome = '$nome', email = '$email', image = '$name',senha = '$senha' WHERE cpf = '$cpf'");
}else{
	$edit = $pdo->query("UPDATE users SET nome = '$nome', email = '$email',senha = '$senha' WHERE cpf = '$cpf'");
}

	


echo 1;
?>