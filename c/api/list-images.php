<?php
include "conn.php";

$user = $_POST['user'];

$id = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();
$images = $pdo->query("SELECT * FROM images WHERE user = '$id'");


if($images->rowCount() > 0){
	foreach ($images as $key) {
		$img[] = array('id'=> $key['id'],
					 'nome'=> $key['nome']); 
	}
	echo json_encode($img);
}
?>