<?php
header("Access-Control-Allow-Origin: *");

include "../conn.php";

$key = $_POST['key'];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url.'/group/getallgroups?key='.$key,
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

echo $response;
