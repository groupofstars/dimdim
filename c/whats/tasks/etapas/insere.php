<?php
include "../../conn.php";
$user = $_POST['user'];
$nome = $_POST['nome'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();


$pdo->query("INSERT INTO etapas_task (nome, user, h_conclusao) VALUES ('$nome', '$owner', 'false')");

echo 1;

?>