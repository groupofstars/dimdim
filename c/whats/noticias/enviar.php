<?php
header("Access-Control-Allow-Origin: *");


include "../conn.php";

$lista = $_POST['lista'];
$cliente = $_POST['cliente'];







$buttons = $pdo->query("SELECT * FROM listas_noticia WHERE id = '$lista'");
foreach($buttons as $b){
	$midia = $b['image'];
	$caption = $b['caption'];
	$num = $b['num'];
	$type = $b['type'];

	
}

$owner = $pdo->query("SELECT owner FROM nums WHERE num = '$num'")->fetchColumn();

//echo "image > ".$midia." caption > ".$caption." instance > ".$num;

$img_video = explode('/', $type)[0];

$urll = $url.'/message/'.$img_video.'?key='.$num.'&id='.$cliente;

echo "url > ".$urll;


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
CURLOPT_POSTFIELDS => array('path' => $path,'file'=> $midia, 'mimetype'=> $type, 'id' => $cliente, 'caption' => $caption, 'msdelay' => '3000'),

	CURLOPT_HTTPHEADER => array(
		'accept: application/json',
		'Content-Type: multipart/form-data',
		'Authorization: Bearer 123'
	),
));

$response = curl_exec($curl);
curl_close($curl);
$response = json_decode($response, true);
$status = $response['data']['status'];


//echo "Enviando para > ".$cliente." status > ".$status;


if($status == 'PENDING'){


	//Creditos
	$creditos = $pdo->query("SELECT saldo FROM users WHERE id = '$owner'")->fetchColumn();
	$desconta = $creditos-1;

	$atualiza = $pdo->query("UPDATE users SET saldo = '$desconta' WHERE id = '$owner'");

	//Insere nos envios
	$hoje = date('Y-m-d');
	$grafico = $pdo->query("INSERT INTO envios (user,data,lista,email) VALUES ('$owner', '$hoje', '0', '0')");

}else{
    $dados = array('status' => 'erro',
                   'cliente' => $cliente);

    print_r($response);
}