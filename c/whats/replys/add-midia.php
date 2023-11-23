<?php
include "../conn.php";

$pergunta = $_POST['pergunta'];
$num = $_POST['num'];

$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('his')."-N".$num;

$texto = $_POST['text'];

$ext = $_POST['ext'];
$midia = date("dmYhis")."n${num}.".$ext;
$type = $_POST['type']; 


move_uploaded_file($_FILES['midia']['tmp_name'], '../images/'.$midia);

$addlista = $pdo->query("INSERT INTO reply (pergunta, responde, num, hash) VALUES ('$pergunta', 'midia','$num', '$hash')");

$addmidia = $pdo->query("INSERT INTO reply_midia (caption, midia, type, hash) VALUES ('$texto', '$midia', '$type', '$hash')");

echo 1;

?>