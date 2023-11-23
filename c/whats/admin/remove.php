<?php

include "../conn.php";

$id = $_POST['user'];

$del = $pdo->query("DELETE FROM users WHERE id = '$id'");
echo 1;
?>