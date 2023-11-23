<?php
include "../../conn.php";

$ip = $_POST['ip'];

$pdo->query("INSERT INTO block_ip (ip) VALUES ('$ip')");
echo 1;
?>