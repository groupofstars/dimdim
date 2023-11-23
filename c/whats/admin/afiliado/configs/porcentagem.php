<?php
include "../../../conn.php";

$porcentagem = $_POST['porcent'];

$pdo->query("UPDATE all_configs SET porcentagem_afd = '$porcentagem'");
echo 1;
?>