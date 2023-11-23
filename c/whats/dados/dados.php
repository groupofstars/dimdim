<?php
include "../conn.php";

$user = $_POST['user'];
$d = $pdo->query("SELECT * FROM users WHERE email = '$user'");


foreach ($d as $key) {
	$id = $key['id'];
	$instancias  = $key['instancias'];
	$cnn = $pdo->query("SELECT count(id) FROM nums WHERE owner = '$id'")->fetchColumn();

	if($cnn < $instancias){
		$i = 1;
	}else {
		$i = 0;
	}
	$exp = $key['expira'];
	$today = date('Y-m-d', strtotime('+7 day'));

	if($today >= $exp){
		$date1 = new DateTime(date('Y-m-d'));
		$date2 = new DateTime($exp);
		$aviso = $date1->diff($date2);
		$aviso = $aviso->format("%R%a");
	}else{
		$aviso = false;
	}
	



	$dados = array('id' => $key['id'],
				   'nome' => $key['nome'],
				   'email' => $key['email'],
				   'contato' => $key['contato'],
				   'senha' => $key['senha'],
				   'plano' => $key['plano'],
				   'expira' => $aviso,
				   'instance' => $i,
				   'cpf' => $key['cpf'],
				   'image' => $key['image']);
}

echo json_encode($dados);
?>