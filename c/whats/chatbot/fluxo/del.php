<?php
include "../../conn.php";

$id = $_POST['id'];
$pdo->query("DELETE FROM chatbot_responde WHERE id = '$id'");
echo 1;

?>