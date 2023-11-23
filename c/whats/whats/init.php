<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url.'/instance/init?key='.$hash.'&webhook=true&webhookUrl=Webhook',
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

if($response['message'] == "Initializing successfully"){
  include "qrcode.php";
}
