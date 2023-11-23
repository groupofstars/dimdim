<?php
include "../conn.php";

$email = $_POST['user'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$email'")->fetchColumn();

$i = $pdo->query("SELECT * FROM nums WHERE status = '1' AND owner = '$owner'");

if($i->rowCount() > 0){
	foreach($i as $k){
		$dados[] = array('n' => $k['num']);
	}

	echo json_encode($dados);
}else{
	echo 0;
}

?>