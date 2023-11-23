<?php
include "../../conn.php";

$task = $_POST['task'];
$etapa = $_POST['etapa'];

$pdo->query("UPDATE list_task SET etapa = '$etapa' WHERE id = '$task'");
echo 1;



/*

*/
?>