<?php
include "../conn.php";


$key = $_POST['key'];
$lista = $_POST['list'];
$grupo = $_POST['grupo']."@g.us";

/*Buscando contatos*/
$con = $pdo->query("SELECT * FROM save_contatos WHERE lista = '$lista'");

if($con->rowCount() > 0){

  foreach($con as $k){
    $contatos[] = $k['contato'];
  }

}else{
 
  echo 0;
}
/*Buscando contatos*/


/*Verificando a existencia do numero*/

$contatos =  json_encode($contatos);


  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://127.0.0.1:3333/group/participantsupdate?key='.$key,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
      "id": "'.$grupo.'",
      "users": '.$contatos.',
      "action": "add"
  }',
    CURLOPT_HTTPHEADER => array(
      'Authorization: Bearer 123',
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);

  $response = json_decode($response, true);

if($response['error'] == false){
 echo 1;
}


?>