<?php
include "../conn.php";

$id = $_POST['id'];
$creditos = $_POST['creditos'];

$c = $pdo->query("SELECT msg_liberada FROM users WHERE id = '$id'")->fetchColumn();

$newc = $c+$creditos;

$upd = $pdo->query("UPDATE users SET msg_liberada = '$newc'");

echo 1;
?>