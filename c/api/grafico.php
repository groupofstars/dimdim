<?php
include "conn.php";

$user = $_POST['user'];

$id = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$dados = array();
for ($mes = 1; $mes <= 12; $mes++) {
    $qtd = $pdo->query("SELECT count(id) FROM envios WHERE user = '$id' AND MONTH(data) = '$mes'")->fetchColumn();
    $dados[] = $qtd;
}

echo implode(",", $dados);


?>