<?php
include "../conn.php";

$user = $_POST['user'];
$email = $_POST['email'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];

$pdo->query("UPDATE users SET email = '$email', nome = '$nome', senha = '$senha' WHERE email = '$user'");

echo 1; 


?>