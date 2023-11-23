<?php
include "../conn.php";

$user = $_POST['user'];
$data = date('Y-m-d h:i:s');
$ip = $_POST['ip'];
$city = $_POST['city'];
$coords = $_POST['coords'];

$id = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$pdo->query("DELETE FROM logs WHERE client = '$id'");
$pdo->query("INSERT INTO logs (client, data, ip, city, coords) VALUES ('$id', '$data', '$ip', '$city', '$coords')");

?>