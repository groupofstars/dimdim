<?php

include "../conn.php";

$hash = $_POST['hash'];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url.'/instance/info?key='.$hash,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer 123'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$response = json_decode($response, true);

sleep(1);

if($response['error'] == false || $response['message'] == 'Instance fetched successfully'){
	include "qrcode.php";
}else if($response['error'] == true || $response['message'] == 'invalid key supplied'){
	include "init.php";
}



?>