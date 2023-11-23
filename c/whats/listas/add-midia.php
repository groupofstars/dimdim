<?php
include "../conn.php";

$nome = $_POST['nome'];
$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$caption = $_POST['text'];


$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('dmyhis')."-U".$owner;

$addlista = $pdo->query("INSERT INTO listas_wpp (nome, owner, tipo, hash) VALUES ('$nome', '$owner', 'midia', '$hash')");

$ext = $_POST['ext'];
$midia = date("dmYhis")."U${owner}.".$ext;
$type = $_POST['type']; 

move_uploaded_file($_FILES['midia']['tmp_name'], '../images/'.$midia);

$addmidia = $pdo->query("INSERT INTO lista_midia (caption, midia, lista, type) VALUES ('$caption', '$midia', '$hash', '$type')");

echo 1;
?>