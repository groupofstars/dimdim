<?php
include "../conn.php";

$pergunta = $_POST['pergunta'];
$num = $_POST['num'];

$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('his')."-N".$num;

$addlista = $pdo->query("INSERT INTO reply (pergunta, responde, num, hash) VALUES ('$pergunta', 'audio','$num', '$hash')");


$audio = date("dmYhis")."U${owner}.mp3";

move_uploaded_file($_FILES['fileaudio']['tmp_name'], '../images/'.$audio);

$addaudio = $pdo->query("INSERT INTO reply_audio (hash, audio) VALUES ('$hash', '$audio')");

echo 1;

?>