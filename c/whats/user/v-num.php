<?php
include "../conn.php";

$user = $_POST['user'];
$id_user = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();
$v = $pdo->query("SELECT nums_liberado FROM users WHERE email = '$user'")->fetchColumn();

$n = $pdo->query("SELECT count(id) FROM nums WHERE owner = '$id_user'")->fetchColumn();

if($v > $n){
	$dados = array('status' => 'true');
}else if($v <= $n){
	$dados = array('status' => 'false');
}

echo json_encode($dados);
?>