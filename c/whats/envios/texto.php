<?php
include "../conn.php";

$lista = $_POST['lista'];
$cliente = $_POST['cliente'];
$num = $_POST['num'];

$owner = $pdo->query("SELECT owner FROM listas_wpp WHERE id = '$lista'")->fetchColumn();


$all = $pdo->query("SELECT * FROM listas_wpp WHERE id = '$lista'");

foreach($all as $k){
	$hash = $k['hash'];
	$owner = $k['owner'];
}


$buttons = $pdo->query("SELECT * FROM mensagem_lista WHERE lista = '$hash'");
foreach($buttons as $b){
	$caption = $b['texto'];
}


$urll = $url.'/message/text?key='.$num.'&id='.$cliente;


$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => $urll,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS => 'id='.$cliente.'&message='.$caption,
 
CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer 123'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$response = json_decode($response, true);
$status = $response['data']['status'];

if($status == 'PENDING'){

    //Insere nos envios
    $hoje = date('Y-m-d');
    $grafico = $pdo->query("INSERT INTO envios (user,data,lista,email) VALUES ('$owner', '$hoje', '0', '0')");

    echo "inserido";

}else{
    $dados = array('status' => 'erro',
                   'cliente' => $cliente);

    print_r($response);
    
}




