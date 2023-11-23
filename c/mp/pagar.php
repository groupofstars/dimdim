<?php
include "../whats/conn.php";
$dados = json_decode(file_get_contents('php://input'), false);


// Dados da sua conta e credenciais do Mercado Pago
$access_token = $pdo->query("SELECT access_token FROM all_configs")->fetchColumn();

// URL da API do Mercado Pago
$api_url = 'https://api.mercadopago.com/v1';

$valor = $dados->transaction_amount;
$pagador = $dados->payer->email;
$token = $dados->token;
$payid = $dados->payment_method_id;
$hash = $dados->hash;
// Dados do pagamento


if($valor){
$payment_data = array(
    'transaction_amount' => $valor,
    'token' => $token, // Token do cartão de crédito gerado pelo Mercado Pago
    'description' => 'FATURA WORDSYSTEM',
    'installments' => 1,
    'payment_method_id' => $payid, // ID do método de pagamento selecionado pelo usuário
    'payer' => array(
        'email' => $pagador // E-mail do pagador
    )
);

$json_payment_data = json_encode($payment_data);

// Configuração da requisição cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url . '/payments');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_payment_data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token
));

// Executa a requisição cURL
$response = curl_exec($ch);

// Verifica se ocorreu algum erro na requisição
if (curl_errno($ch)) {
    echo 'Erro na requisição: ' . curl_error($ch);
} else {
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_status == 201) {
        // Pagamento criado com sucesso
        $payment_info = json_decode($response, true);
        $paymentId =  $payment_info['id'];
        $pdo->query("UPDATE mensalidades SET pid = '$paymentId' WHERE id = '$hash'");
        echo json_encode(array('status' => true));
    } else {
        // Erro ao criar o pagamento
        echo json_encode(array('status' => false));
    }
}

// Fecha a requisição cURL
curl_close($ch);


}
?>