<?php 
include "../conn.php";

$lista = $_POST['lista'];
$cliente = $_POST['cliente'];
$num = $_POST['num'];



$all = $pdo->query("SELECT * FROM listas_wpp WHERE id = '$lista'");

foreach($all as $k){
	$hash = $k['hash'];
	$owner = $k['owner'];
}

$lista_button = $pdo->query("SELECT * FROM lista_buttons WHERE lista = '$hash'");

foreach($lista_button as $key){
    $title = $key['title'];
    $footer = $key['footer'];

}



$buttons = $pdo->query("SELECT * FROM buttons WHERE hash = '$hash'");

foreach($buttons as $key){
    $btns[] = array('buttonId' => $key['botao'],
                    'buttonText' => ['displayText' => $key['botao']],
                    'type' => '1');
}

$btns = json_encode($btns);



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url.'/message/button?key='.$num,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
            "id": "'.$cliente.'",
             "msdelay": 1000,
             "btndata": {
             "text": "'.$title.'",
             "buttons": '.$btns.',
             "footerText": "'.$footer.'",
             "headerType": 1
             }
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
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

}else{
    $dados = array('status' => 'erro',
                   'cliente' => $cliente);

    print_r($response);
}






?>