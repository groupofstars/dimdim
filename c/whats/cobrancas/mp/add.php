<?php
include "../../conn.php";

$user = $_POST['user'];
$nome = $_POST['nome'];
$at = $_POST['at'];
$pk = $_POST['pk'];
$tipo = $_POST['tipo'];


$owner = $pdo->query("SELECT * FROM users WHERE email = '$user'")->fetchColumn();

$pdo->query("INSERT INTO mercadopago (nome, owner, access_token, pub_key, tipo) VALUES ('$nome', '$owner', '$at', '$pk', '$tipo')");

echo 1;

?>