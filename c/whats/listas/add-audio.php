<?php

include "../conn.php";

$nome = $_POST['nome'];
$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('dmyhis')."-U".$owner;


$addlista = $pdo->query("INSERT INTO listas_wpp (nome, owner, tipo, hash) VALUES ('$nome', '$owner', 'audio', '$hash')");

$audio = date("dmYhis")."U${owner}.mp3";

move_uploaded_file($_FILES['fileaudio']['tmp_name'], '../images/'.$audio);

$addmidia = $pdo->query("INSERT INTO lista_audio (lista, audio) VALUES ('$hash', '$audio')");

echo 1;

?>