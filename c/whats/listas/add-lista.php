<?php
include "../conn.php";
$user = $_POST['user'];

$nome = $_POST['nome'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();
$msg_text = $_POST['text'];
$type = @$_POST['type'];
$ext = @$_POST['ext'];

$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('dmyhis')."-U".$owner;


//echo "${nome}\n${owner}\n${msg_text}\n${msg_midia}\n${type}\n${ext}\n${string}\n${hash}";


if(!empty($_FILES['midia'])){	
	
	$nome_midia = date("dmYhis")."U${owner}.".$ext;
	
	move_uploaded_file($_FILES['midia']['tmp_name'], '../images/'.$nome_midia);

	$add = $pdo->query("INSERT INTO listas_wpp (nome, owner, msg_txt, msg_midia, hash) VALUES ('$nome', '$owner', '$msg_text', 'true', '$hash')");

	//echo "${nome}\n${owner}\n${msg_text}\ntrue\n${hash}";

	$addmidia = $pdo->query("INSERT INTO msg_midia (midia, type, hash) VALUES ('$nome_midia', '$type', '$hash')");

	echo 1;

}else{

	$add = $pdo->query("INSERT INTO listas (nome, owner, msg_txt, msg_midia, hash) VALUES ('$nome', '$owner', '$msg_text', 'false', '$hash')");

	echo 1;
}
?>