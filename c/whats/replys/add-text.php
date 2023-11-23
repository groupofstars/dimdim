<?php
include "../conn.php";

$pergunta = $_POST['pergunta'];
$num = $_POST['num'];

$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('his')."-N".$num;

$addlista = $pdo->query("INSERT INTO reply (pergunta, responde, num, hash) VALUES ('$pergunta', 'texto','$num', '$hash')");



$texto = $_POST['text'];

$addtext = $pdo->query("INSERT INTO reply_text (texto, hash) VALUES ('$texto', '$hash')");

echo 1;
?>