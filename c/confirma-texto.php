<?php

/*Dados do agendamento*/
$esp = $pdo->query("SELECT * FROM espera WHERE status = '0' AND SUBSTR(cliente, -7) = '$sender_format' AND instance = '$destinatario'");
foreach ($esp as $key){
    $id_this = $key['id'];
    $id_consulta = $key['id_consulta'];
    $url_confirma = $key['url'];
    $erro_msg = $key['msg_erro'];
    $confirma_msg = $key['msg_confirma'];
    $reagenda_msg = $key['msg_reagenda'];
}
/*Dados do agendamento*/


/*Mensagem de retorno*/
if($msg == "1"){
    $status = "1";
    $msg_retorna = $confirma_msg; 
    
}else if($msg == "2"){
    $status = "2";
    $msg_retorna = $reagenda_msg;
    
}else{
    $status = '';
    
    /*Mensagem de erro*/
    $msg_retorna = $erro_msg;
    /*Mensagem de erro*/
    
}   
/*Mensagem de retorno*/


if($status != ''){
    /*Mudando o status no banco de dados*/
    $pdo->query("UPDATE espera SET status = '1' WHERE id = '$id_this'");
    /*Mudando o status no banco de dados*/
}

/*Devolvendo a resposta ao cliente*/
 $url = "http://api.dimdimbet.com/send-text";
 
 
  $owner = $pdo->query("SELECT owner FROM nums WHERE num = '$destinatario'")->fetchColumn();
  $token =  $pdo->query("SELECT token FROM users WHERE id = '$owner'")->fetchColumn();
 
  $data = array('instance' => $destinatario,
                'to' => $sender,
                'token' => $token,
                'message' => $msg_retorna);


  $options = array('http' => array(
                 'method' => 'POST',
                 'content' => http_build_query($data)
  ));

  $stream = stream_context_create($options);

  $result = file_get_contents($url, false, $stream);
/*Devolvendo a resposta ao cliente*/

if($status != ''){ 

/*Enviando a mensagem pro servidor do cliente*/
 $data_confirm = array('id' => $id_consulta,
                'status' => $status);
  $data_confirm = json_encode($data_confirm);
  $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url_confirma,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $data_confirm,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
/*Enviando a mensagem pro servidor do cliente*/
}


?>