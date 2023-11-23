<?php
include "../conn.php";

$dados = json_decode(file_get_contents('php://input'), false);


$user = $dados->user;
$instance_name  = $dados->nome;
$itens = $dados->itens;
if($instance_name == ''){
  $instance_name = "Sem nome > ".date('d-m-y h:i');
}

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$hash = substr(str_shuffle($string), 0, 3).date('dmyhis')."OWN".$owner;



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url.'/instance/init?key='.$hash.'&webhook=true',
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

/*
$response = array();
$response['message'] = "Initializing successfully";*/
if($response['message'] == "Initializing successfully"){
 
  $pdo->query("INSERT INTO nums (nome, owner, num, status) VALUES ('$instance_name','$owner','$hash', '0')");
  

   /*Comparativo de datas pro proximo pagamento*/
    $exp = $pdo->query("SELECT expira FROM users WHERE id = '$owner'")->fetchColumn();
    $hoje = date('Y-m-d');
    $verificaMensalidade = $pdo->query("SELECT * FROM mensalidades WHERE data > '$hoje' AND user = '$owner'");

if(strtotime($exp) > strtotime($hoje)){
     if($verificaMensalidade->rowCount() > 0){
        $proxMes = date('Y-m-d', strtotime('+1 month', strtotime($exp)));
        $proxPay = date('Y-m-01', strtotime($proxMes));
        $pdo->query("UPDATE mensalidades SET data = '$proxPay' WHERE user = '$owner'");

        echo json_encode(array('status' => 'success', 'hash'=> $hash, 'prox' => $proxPay, 'update' => true));
    }else{

        $proxMes = date('Y-m-d', strtotime('+1 month', strtotime($exp)));
        $proxPay = date('Y-m-01', strtotime($proxMes));
        $pdo->query("INSERT INTO mensalidades (user, data, status) VALUES ('$owner', '$proxPay', '0')");
         echo json_encode(array('status' => 'success', 'hash'=> $hash, 'prox' => $proxPay, 'create' => true));
    }
}else if(strtotime($exp) < strtotime($hoje)){
    if($verificaMensalidade->rowCount() > 0){
        $proxMes = date('Y-m-d', strtotime('+1 month', strtotime($hoje)));
        $proxPay = date('Y-m-01', strtotime($proxMes));
        $pdo->query("UPDATE mensalidades SET data = '$proxPay' WHERE user = '$owner'");

        echo json_encode(array('status' => 'success', 'hash'=> $hash, 'prox' => $proxPay, 'update' => true));
    }else{

        $proxMes = date('Y-m-d', strtotime('+1 month', strtotime($hoje)));
        $proxPay = date('Y-m-01', strtotime($proxMes));
        $pdo->query("INSERT INTO mensalidades (user, data, status) VALUES ('$owner', '$proxPay', '0')");
         echo json_encode(array('status' => 'success', 'hash'=> $hash, 'prox' => $proxPay, 'create' => true));
    }
}
    

}else {
  echo 0;
}





?>