<?php
include "../conn.php";

$email = $_POST['user'];
$num = $_POST['num'];


$user = $pdo->query("SELECT id FROM users WHERE email = '$email'")->fetchColumn();

$v = $pdo->query("SELECT * FROM confirm_num WHERE num = '$num' AND user = '$user'");


$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
$codigo = substr(str_shuffle($string), 0, 6);


if($v->rowCount() > 0){
	$pdo->query("UPDATE confirm_num SET codigo = '$codigo' WHERE user = '$user' AND num = '$num'");
}else{
	$pdo->query("INSERT INTO confirm_num (user, num, codigo) VALUES ('$user', '$num', '$codigo')");
}

$key = $pdo->query("SELECT instancia FROM config_cobranca")->fetchColumn();


$urll = $url.'/message/text?key='.$key.'&id='.$num;
$caption = '*SEU CÓDIGO DE VERIFICAÇÃO*
Código: *'.$codigo.'*
Copie e Confirme na plataforma';

$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => $urll,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS => 'id='.$num.'&message='.$caption,
 
CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer 123'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$response = json_decode($response, true);
$status = $response['data']['status'];

if($status == 'PENDING'){
	echo 1;
}else{
   echo 0;
    
}

?>