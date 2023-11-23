<?php
include "../conn.php";

$user = $_POST['user'];

$id = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$dados = array();
for ($mes = 1; $mes <= 12; $mes++) {
    $qtd_users = $pdo->query("SELECT count(id) FROM users WHERE afiliado = '$id' AND MONTH(criado) = '$mes'")->fetchColumn();
    $dados_users[] = $qtd_users;

    $qtd_vendas = $pdo->query("SELECT count(id) FROM pagamentos WHERE afiliado = '$id' AND MONTH(data) = '$mes'")->fetchColumn();
    $dados_vendas[] = $qtd_vendas;
}


$dados_totais = array('users' => implode(",", $dados_users),
                      'vendas' => implode(",", $dados_vendas));

echo json_encode($dados_totais);


?>