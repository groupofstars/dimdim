<?php
include "../conn.php";

$user = $_POST['user'];
$text = $_POST['text'];
$nome = $_POST['nome'];


$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('dmyhis')."-U".$owner;

$addlista = $pdo->query("INSERT INTO listas_wpp (nome, owner, tipo, hash) VALUES ('$nome', '$owner', 'texto', '$hash')");

$addtext = $pdo->query("INSERT INTO mensagem_lista (texto, lista) VALUES ('$text', '$hash')");

echo 1;

?>