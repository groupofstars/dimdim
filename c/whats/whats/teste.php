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
  $hoje = date('Y-m-d');
 
  foreach($itens as $key){
    $item = $key->item;
    $pdo->query("INSERT INTO myplan (instance, item, data) VALUES ('$hash', '$item', '$hoje')");
  }
  
    /*Comparativo de datas pro proximo pagamento*/
    $exp = $pdo->query("SELECT expira FROM users WHERE id = '$owner'")->fetchColumn();
    $hoje = date('Y-m-d');

    if(strtotime($exp) > strtotime($hoje)){
      /*Verifica uma mensalidade ja criada*/
        $mensalidades = $pdo->query("SELECT * FROM  mensalidades WHERE data >  '$hoje' AND status = 0"); 
      
        if($mensalidades->rowCount() > 0){
           $proxMes = date('Y-m-d', strtotime('+1 month', strtotime($exp)));
           $proxPay = date('Y-m-01', strtotime($proxMes));
           $pdo->query("UPDATE mensalidades SET data = '$proxPay' WHERE user = '$owner'");
        }else{
           $proxMes = date('Y-m-d', strtotime('+1 month', strtotime($exp)));
           $proxPay = date('Y-m-01', strtotime($proxMes));
           $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
           $hash = substr(str_shuffle($string), 0, 3).$proxPay."PAY".$owner;

           $pdo->query("INSERT INTO mensalidades (user, data, status, hash) VALUES ('$owner', '$proxPay', '0', '$hash')");
        }
      /*Verifica uma mensalidade ja criada*/
    }else{
      /*Verifica uma mensalidade ja criada*/
      $mensalidades = $pdo->query("SELECT * FROM  mensalidades WHERE data >  '$hoje' AND status = 0"); 
      
      if($mensalidades->rowCount() > 0){
         $proxMes = date('Y-m-d', strtotime('+1 month', strtotime($hoje)));
         $proxPay = date('Y-m-01', strtotime($proxMes));
         $pdo->query("UPDATE mensalidades SET data = '$proxPay' WHERE user = '$owner'");
      }else{
         $proxMes = date('Y-m-d', strtotime('+1 month', strtotime($hoje)));
         $proxPay = date('Y-m-01', strtotime($proxMes));

         $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
         $hash = substr(str_shuffle($string), 0, 3).$proxPay."PAY".$owner;

         $pdo->query("INSERT INTO mensalidades (user,data, status, hash) VALUES ('$owner', '$proxPay', '0', '$hash')");
      }

      /*Verifica uma mensalidade ja criada*/
    }
    /*Comparativo de datas pro proximo pagamento*/
  echo 1;

}else {
  echo 0;
}





?>