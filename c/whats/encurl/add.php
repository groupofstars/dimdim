<?php
include "../conn.php";

$user = $_POST['user'];
$url = $_POST['url'];
$enc = $_POST['enc'];

$url = str_replace('#', '&', $url);

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

if($enc == ''){
	$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
	$enc = substr(str_shuffle($string), 0, 3).date('his').$owner;
}

$verifica = $pdo->query("SELECT * FROM enc_url WHERE enc = '$enc'");

if($verifica->rowCount() > 0){
	echo 0;
}else{
	$pdo->query("INSERT INTO enc_url (url, enc, cliques, owner) VALUES ('$url', '$enc', '0', '$owner')");

	echo 1;
}


?>