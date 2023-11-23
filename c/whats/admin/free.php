<?php
include "../conn.php";

$dias = $pdo->query("SELECT dias_free FROM all_configs")->fetchColumn();

echo $dias;
?>