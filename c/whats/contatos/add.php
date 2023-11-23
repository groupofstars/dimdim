<?php
include "../conn.php";
$user = $_POST['user'];
$nome = $_POST['nome'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$pdo->query("INSERT INTO lista_contatos  (nome, owner) VALUES ('$nome', '$owner')");
echo 1;

?>