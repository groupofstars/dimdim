<?php
include "conn.php";

$id = $_POST['id'];

$nome = $pdo->query("SELECT nome FROM images  WHERE id = '$id'")->fetchColumn();

unlink("../../images/".$nome);
$deleta = $pdo->query("DELETE FROM  images WHERE id = '$id'");
echo 1;
?>