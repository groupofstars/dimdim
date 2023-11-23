<?php
include "../../conn.php";

$id = $_POST['id'];

$imagem  = $pdo->query("SELECT img FROM banners WHERE id = '$id'")->fetchColumn();
unlink('img/'.$imagem);

$pdo->query("DELETE FROM banners WHERE  id = '$id'");
echo 1;
?>