<?php
sleep(1);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:3333/misc/updateProfilePicture?key='.$key,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "id": "'.$id.'",
    "url": "'.$path.$imagem.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer 123',
    'Content-Type: application/json'
  ),
));

$response3 = curl_exec($curl);

curl_close($curl);

$response3 = json_decode($response3, true);

if($response3['error'] == false){
  echo 1;
}