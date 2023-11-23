<?php
include "../conn.php";

$user = $_POST['user'];
$pixel = $_POST['pixel'];
$pdo->query("UPDATE users SET pixel_fb = '$pixel' WHERE email = '$user'");
echo 1;
?>