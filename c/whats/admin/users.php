<?php
include "../conn.php";

$user = $_POST['user'];
$limite = $_POST['limite'];

if($user == 'all'){
	$users = $pdo->query("SELECT * FROM users WHERE nivel = '0' ORDER BY id DESC LIMIT $limite");
}else{
	$users = $pdo->query("SELECT * FROM users WHERE nivel = '0' AND email  LIKE  '%".$user."%' LIMIT 5");
}



if($users->rowCount() > 0){

	foreach($users as $k){

		$data_unix = strtotime($k['expira']);
		$diferenca_segundos = $data_unix - time();
		$diferenca_dias = round($diferenca_segundos / 86400);
		
		if ($diferenca_dias < 0) {
    		$vence = "vencido";
		} elseif ($diferenca_dias <= 3) {
		    $vence = "quase";
		} else {
		   $vence = "emdia";
		}


		$dados[] =  array('id' => $k['id'],
						  'nome' => $k['nome'],
						  'email' => $k['email'],
						  'cpf' => $k['cpf'],
						  'vencido' => $vence,
						  'nivel' => $k['nivel'],
						  'expira' => $k['expira'],
						  'status' => $k['status']);
	}

	echo json_encode($dados);
}else{
	echo 0;
}
?>