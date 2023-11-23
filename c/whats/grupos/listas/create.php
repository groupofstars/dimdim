<?php
include "../../conn.php";

$user = $_POST['user'];
$user = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();
$nome = $_POST['nome'];


$pdo->query("INSERT INTO listas_save_contatos (nome, user) VALUES ('$nome', '$user')");

echo 1;


?>