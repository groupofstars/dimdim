<?php
include "../conn.php";



$key = $_POST['key'];
$nome = $_POST['nome'];
$desc = $_POST['desc'];
$add_con = $_POST['add'];
$list = $_POST['list'];

if($add_con == "sim"){

	$u = $pdo->query("SELECT * FROM save_contatos WHERE lista = '$list'");
	foreach($u as $k){
		$users[] = $k['contato'];
	}

}else{
	$users = [];
}

if(isset($_FILES['imagem'])){
    
    $imagem = date('dmyhis').$owner.$_FILES['imagem']['name'];
    move_uploaded_file($_FILES['imagem']['tmp_name'], '../images/'.$imagem);
  }


$users = json_encode($users);


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:3333/group/create?key='.$key,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "name": "'.$nome.'",
    "users": '.$users.'
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer 123',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

//echo $response;

$response = json_decode($response, true);


$status = $response['error'];


if($status == false){
	$id = $response['data']['id'];
	
	if(isset($desc)){
		include "add-desc.php";
	}


	
}else{
	$dados = array('status' => 'erro');
}

echo json_encode($dados);


?>