<?php
include "../conn.php";

$id = $_POST['id'];
$vencimento = $_POST['vencimento'];


$upd = $pdo->query("UPDATE users SET vencimento = '$vencimento'");

echo 1;
?>