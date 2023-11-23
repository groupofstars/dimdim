<?php
include "../../conn.php";

$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$instancias = $pdo->query("SELECT * FROM nums WHERE status = '1' AND owner = '$owner'");

if($instancias->rowCount() > 0){
	foreach($instancias as $key){
		$dados[] = array('instancia' => $key['num'],
						 'nome' => $key['nome']);
	}

	echo json_encode($dados);
}else{
	echo 0;
}
?>