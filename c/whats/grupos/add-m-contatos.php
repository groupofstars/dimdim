<?php

$dados = json_decode(file_get_contents('php://input'), false);

$key = $dados->key;
$grupo = $dados->grupo."@g.us";
$contato = $dados->contato;


sleep(1);
if(isset($contato)){

	

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
	    "users": ["'.$contato.'"],
	    "action": "add"
	}',
	  CURLOPT_HTTPHEADER => array(
	    'Authorization: Bearer 123',
	    'Content-Type: application/json'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);

	$response = json_decode($response, false);
    if(isset($response)){
       // echo json_encode($response);
    	if($response->data[0]->status == "200"){
    		$dados = array('status' => 1,
    					   'resp' => $response);
    	}else{
    		$dados = array('status' => 0,
    					   'resp' => $contato);
    	}
    }

	
	echo json_encode($dados);
}

	


?>