<?php
include "../whats/conn.php";
$dados = json_decode(file_get_contents('php://input'), false);

$payment_id = $dados->data->id; // Obtém o ID do pagamento recebido pelo webhook

// Dados da sua conta e credenciais do Mercado Pago
// 'TEST-7526589347946438-020903-9610eefbaeb5e57c0c1fe2558de6b5dc-718367722' (teste)
$access_token = $pdo->query("SELECT access_token FROM all_configs")->fetchColumn();

// URL da API do Mercado Pago
$api_url = 'https://api.mercadopago.com/v1';

// Configuração da requisição cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url . '/payments/' . $payment_id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $access_token
));

// Executa a requisição cURL
$response = curl_exec($ch);

// Verifica se ocorreu algum erro na requisição
if (curl_errno($ch)) {
    echo 'Erro na requisição: ' . curl_error($ch);
} else {
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_status == 200) {
        // Pagamento encontrado
        $payment_info = json_decode($response, true);
        $payment_id = $payment_info['id'];
        $status = $payment_info['status'];
        $valor = $payment_info['transaction_amount'];
       // echo 'Pagamento encontrado. ID: ' . $payment_id . ', Status: ' . $status;

        if($status == 'approved'){
            $pdo->query("UPDATE mensalidades SET status = '1', valor = '$valor' WHERE pid = '$payment_id'");
            /*Verificando o usuario*/
            $owner = $pdo->query("SELECT user FROM mensalidades WHERE pid = '$payment_id'")->fetchColumn();
            /*Verificando o usuario*/

            /*Deletando as pendencias canceladas*/
            $pdo->query("DELETE FROM diplan WHERE user = '$owner'");
            /*Deletando as pendencias canceladas*/

            /*Criando a proxima mensalidade*/
            $dataPay = $pdo->query("SELECT data FROM mensalidades WHERE pid = '$payment_id'")->fetchColumn();
            $dataTime = new DateTime($dataPay);
            $dataTime->modify('+1 month');
            $nextPayment = $dataTime->format('Y-m-d');
            $pdo->query("INSERT INTO mensalidades (user, data, status) VALUES ('$owner', '$nextPayment', '0')");
            /*Criando a proxima mensalidade*/
        }
    } else {
        // Pagamento não encontrado ou erro na requisição
        echo 'Erro na verificação do pagamento. Código: ' . $http_status . ', Mensagem: ' . $response;
    }
}

// Fecha a requisição cURL
curl_close($ch);


?>