<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:3333/group/updatedescription?key='.$key,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "id": "'.$id.'",
    "description": "'.$desc.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer 123',
    'Content-Type: application/json'
  ),
));

$response2 = curl_exec($curl);

curl_close($curl);

$response2 = json_decode($response2, true);

if($response2['error'] == false){
  include "add-img.php";
}else{
  echo "erro na descrição";
}


