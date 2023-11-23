<?php
include "../whats/conn.php";

$dados = json_decode(file_get_contents('php://input'), false);


// Dados de autenticação
$access_token = $pdo->query("SELECT access_token FROM all_configs")->fetchColumn();

// Dados do pagamento
$valor = (float)$dados->valor;
$descricao = 'FATURA WORDSYSTEM';
$hash = $dados->hash;
// Inicia a sessão cURL
$ch = curl_init();

// URL para criar o pagamento Pix
$url = 'https://api.mercadopago.com/v1/payments/';

// Configura as opções do cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

// Define os cabeçalhos de autenticação
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token
));

// Parâmetros de pagamento
$data = array(
    'transaction_amount' => $valor,
    'description' => $descricao,
    'payment_method_id' => 'pix',
    'payer' => array(
        'email' => $dados->email
    )
);

// Codifica os parâmetros em JSON
$json_data = json_encode($data);

// Define os parâmetros da requisição cURL
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

// Executa a requisição cURL
$response = curl_exec($ch);

// Verifica erros
if ($response === false) {
    echo 'Erro: ' . curl_error($ch);
    curl_close($ch);
    exit;
}

// Decodifica a resposta JSON
$response_data = json_decode($response, true);

// Verifica se ocorreu algum erro na resposta
if (isset($response_data['error'])) {
    //echo 'Erro: ' . $response_data['message'];
     echo json_encode(array('status' => true, 'erro' => $response_data['message']));
    curl_close($ch);
    exit;
}


// Extrai informações do pagamento

$paymentId = $response_data['id'];
$qrcode64 = $response_data['point_of_interaction']['transaction_data']['qr_code_base64'];
$qrcode = "data:image/png;base64,$qrcode64";
$codePix = $response_data['point_of_interaction']['transaction_data']['qr_code'];

$pdo->query("UPDATE mensalidades SET pid = '$paymentId' WHERE id = '$hash'");

 echo json_encode(array('status' => true, 'qrcode' => $qrcode, 'codePix' => $codePix));
//echo "<pre>";print_r($response_data);echo"</pre>";

// Fecha a sessão cURL
curl_close($ch);
