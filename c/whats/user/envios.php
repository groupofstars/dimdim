<?php
include "../conn.php";

$user = $_POST['user'];

$id = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$jan = $pdo->query("SELECT count(id) FROM historico_env WHERE user = '$id' AND MONTH(data) = '01'")->fetchColumn();
$fev = $pdo->query("SELECT count(id) FROM historico_env WHERE user = '$id' AND MONTH(data) = '02'")->fetchColumn();
$mar = $pdo->query("SELECT count(id) FROM historico_env WHERE user = '$id' AND MONTH(data) = '03'")->fetchColumn();
$abr = $pdo->query("SELECT count(id) FROM historico_env WHERE user = '$id' AND MONTH(data) = '04'")->fetchColumn();
$mai = $pdo->query("SELECT count(id) FROM historico_env WHERE user = '$id' AND MONTH(data) = '05'")->fetchColumn();
$jun = $pdo->query("SELECT count(id) FROM historico_env WHERE user = '$id' AND MONTH(data) = '06'")->fetchColumn();
$jul = $pdo->query("SELECT count(id) FROM historico_env WHERE user = '$id' AND MONTH(data) = '07'")->fetchColumn();
$ago = $pdo->query("SELECT count(id) FROM historico_env WHERE user = '$id' AND MONTH(data) = '08'")->fetchColumn();
$set = $pdo->query("SELECT count(id) FROM historico_env WHERE user = '$id' AND MONTH(data) = '09'")->fetchColumn();
$out = $pdo->query("SELECT count(id) FROM historico_env WHERE user = '$id' AND MONTH(data) = '10'")->fetchColumn();
$nov = $pdo->query("SELECT count(id) FROM historico_env WHERE user = '$id' AND MONTH(data) = '11'")->fetchColumn();
$dez = $pdo->query("SELECT count(id) FROM historico_env WHERE user = '$id' AND MONTH(data) = '12'")->fetchColumn();


echo $jan.",".$fev.",".$mar.",".$abr.",".$mai.",".$jun.",".$jul.",".$ago.",".$set.",".$out.",".$nov.",".$dez;

?>