<?php
include "conn.php";

$user = $_POST['user'];
$id = $pdo->query("SELECT id FROM users WHERE  email = '$user'")->fetchColumn();

$leadsemail = $pdo->query("SELECT count(id)  FROM emails WHERE owner = '$id'")->fetchColumn();

$leadswpp = $pdo->query("SELECT count(id)  FROM leads WHERE owner = '$id'")->fetchColumn();

$leads = $leadswpp+$leadsemail;

$listas = $pdo->query("SELECT count(id)  FROM listas WHERE owner = '$id'")->fetchColumn();

$envios = $pdo->query("SELECT count(id)  FROM envios WHERE user = '$id'")->fetchColumn();

$creditos = $pdo->query("SELECT saldo FROM users WHERE id = '$id'")->fetchColumn();


$whats_nums = $pdo->query("SELECT count(id) FROM nums WHERE owner = '$id'")->fetchColumn();

$whats_listas = $pdo->query("SELECT count(id) FROM listas_wpp WHERE owner = '$id'")->fetchColumn();

//$replys = $pdo->query("SELECT count(id) FROM reply WHERE owner = '$id'")->fetchColumn();

$imgs = $pdo->query("SELECT count(id) FROM images WHERE user = '$id'")->fetchColumn();

$nivel = $pdo->query("SELECT nivel FROM users WHERE id = '$id'")->fetchColumn();

$dados = array('leads' => $leads,
			   'listas' => $listas,
			   'envios' => $envios,
			   'creditos' => $creditos,
			   'whats_nums' => $whats_nums,
			   'whats_listas' => $whats_listas,
			   'imagens' => $imgs,
			   'nivel' => $nivel);

echo json_encode($dados);
?>