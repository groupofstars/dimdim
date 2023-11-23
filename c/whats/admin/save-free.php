<?php
include "../conn.php";

$dias = $_POST['dias'];
$pdo->query("UPDATE all_configs SET dias_free = '$dias'");
echo 1;
?>