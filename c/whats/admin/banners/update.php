<?php
include "../../conn.php";

$id = $_POST['id'];
$posicao = $_POST['posicao'];

$pdo->query("UPDATE banners SET posicao = '$posicao' WHERE id = '$id'");


?>