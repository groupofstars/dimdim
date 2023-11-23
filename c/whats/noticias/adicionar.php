<?php

include "../conn.php";


$dados = json_decode(file_get_contents('php://input'), false);

$user = $dados->user;



$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$num = $dados->instance;


$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3)."-".date('dmyhis')."-U".$owner;



$data = date('Y-m-d');

$nomelista = $dados->nomelista;

$pdo->query("INSERT INTO noticias (nome, grupo, data, status, owner,num) VALUES ('$nomelista', '$hash', '$data', '0', '$owner', '$num')");



foreach($dados->data as $key){

	$caption = $key->text;
	$image = $key->file;
	$date = $key->hora;
	$type = $key->type;
	

	if($date == ''){
		$date = date('Y-m-d h:i:s');
	}
	
	$image = str_replace('data:'.$type.';base64,', '', $image);
	$image = str_replace(' ', '+', $image);
	$data_img = base64_decode($image);

	$no_duplicate = str_replace(" ", "-", $key->name_file);
	$ext = explode('.', $no_duplicate)[1];


	$name_img = $key->name_file;//date('dmYhis')."ow".$owner.'.'.$ext;

	$file = '../images/'.$name_img;

	$move = file_put_contents($file, $data_img);


	$pdo->query("INSERT INTO listas_noticia (caption, image, data, grupo, status, num, type) VALUES ('$caption', '$name_img', '$date', '$hash', '0', '$num', '$type')");

}


echo 1;


?>