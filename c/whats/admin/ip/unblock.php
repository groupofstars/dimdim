<?php
include "../../conn.php";

$ip = $_POST['ip'];

$pdo->query("DELETE FROM block_ip WHERE ip = '$ip'");
echo 1;
?>