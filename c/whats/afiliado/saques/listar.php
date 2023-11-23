<?php
include "../../conn.php";


$user = $_POST['user'];
$data_init = @$_POST['data_int'];
$data_final = @$_POST['data_final'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();


if($data_init == '0' || $data_final == '0'){
	$listar = $pdo->query("SELECT * FROM solicita_saque  WHERE user = '$owner' ORDER BY id DESC LIMIT 15");
}else{
	$listar = $pdo->query("SELECT * FROM solicita_saque WHERE data BETWEEN '$data_init' AND '$data_final' AND user = '$owner' ORDER BY data ASC");
}


if($listar->rowCount() > 0){
	foreach($listar as $key){
		$data = date('d/m/Y | H:i:s', strtotime($key['data']));
		$dados[] = array('id' => $key['id'],
						 'valor' => $key['valor'],
						 'status' => $key['status'],
						 'data' => $data,
						 'msg' => $key['msg']); 
	}

	echo json_encode($dados);
}else{
	echo 0;
}


?>