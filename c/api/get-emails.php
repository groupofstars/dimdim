<?php
include "conn.php";

$owner = $_POST['owner'];
$lista = $_POST['lista'];
$id_owner = $pdo->query("SELECT id FROM users WHERE email = '$owner'")->fetchColumn();

$e = $pdo->query("SELECT * FROM contas WHERE owner = '$id_owner'");
$el = $pdo->query("SELECT * FROM emails WHERE lista = '$lista'");

if($e->rowCount() > 0 || $el->rowCount() > 0){
	foreach ($e as $key) {
		$e1[] = array('email' => $key['email'],
					  'nivel' => 0); 
	}

	foreach($el as $t){
		$e2[] = array('email' => $t['email'],
					  'nivel' => 1);
	}
	
	$emails = array($e1,$e2); 
	echo json_encode($emails);
}else{
	echo 0;
}


?>