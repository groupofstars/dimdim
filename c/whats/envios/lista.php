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


$lista = $pdo->query("SELECT * FROM lista_lista WHERE hash = '$hash'");
foreach($lista as $k){
	$button = $k['button'];
	$desc = $k['description'];
	$title = $k['title'];
	$texto = $k['texto'];
}


$buttons = $pdo->query("SELECT * FROM row_list WHERE hash = '$hash'");

foreach($buttons as $k){
	$btns[] = array('title' => $k['title'],
					'description' => $k['description'],
					'rowId' => $k['identifica']);
} 


$btns = json_encode($btns);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url.'/message/list?key='.$num,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "id": "'.$cliente.'",
  "msgdata": {
    "buttonText": "'.$button.'",
    "text": "'.$texto.'",
    "title": "'.$title.'",
    "description": "'.$desc.'",
    "sections": [
      {
        "title": "'.$title.'",
        "rows": '.$btns.'
      }
    ],
    "listType": 0
  }
}',

CURLOPT_HTTPHEADER => array('Content-Type: application/json',
							'Authorization: Bearer 123'),
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