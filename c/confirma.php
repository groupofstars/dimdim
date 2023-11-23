
<?php
$esp = $pdo->query("SELECT * FROM espera WHERE  SUBSTR(cliente, -7) = '$sender_format' AND instance = '$destinatario'");
foreach ($esp as $key){
    $id_agendamento = $key['id']; 
    $confirma_msg = $key['msg_confirma'];
    $reagenda_msg = $key['msg_reagenda'];
    $url_confirm = $key['url'];
    $status_env = $key['status'];
}

 $cfm = explode('.', $msg)[1];
 $status = explode('-', $cfm)[0];
 $id = explode('-', $cfm)[1];
 
 
 if($status == 'yes'){
     $status = '1';
     $mensagem = $confirma_msg;
     
 }else if($status == 'no'){
     $status = '2';
     $mensagem = $reagenda_msg;
 }
 
if($status_env != '2'){
 
  $url = "http://api.dimdimbet.com/send-text";
 
  $owner = $pdo->query("SELECT owner FROM nums WHERE num = '$destinatario'")->fetchColumn();
  $token =  $pdo->query("SELECT token FROM users WHERE id = '$owner'")->fetchColumn();
 
  $data = array('instance' => $destinatario,
                'to' => $sender,
                'token' => $token,
                'message' => $mensagem);


  $options = array('http' => array(
                 'method' => 'POST',
                 'content' => http_build_query($data)
  ));

  $stream = stream_context_create($options);

  $result = file_get_contents($url, false, $stream);

  
  $data_confirm = array('id' => $id,
                        'status' => $status);
                        
  $data_confirm = json_encode($data_confirm);
  
  $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url_confirm,
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
    
    
     $pdo->query("UPDATE espera SET status = '2' WHERE id = '$id_agendamento'");
}
  

?>