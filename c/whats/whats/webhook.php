<?php
include "../conn.php";

$json = json_decode(file_get_contents("php://input"));


    $key = $json->instanceKey;
    $define = $pdo->query("UPDATE nums SET status = 1 WHERE num = '$key'");

echo 1;
?>