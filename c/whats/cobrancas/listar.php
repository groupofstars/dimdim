<?php
include "../conn.php";
$user = $_POST['user'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$cobrancas = $pdo->query("SELECT * FROM cobrancas WHERE owner = '$owner'");

if($cobrancas->rowCount() > 0){
	foreach($cobrancas as $key){
		$dados[] = array('id' => $key['id'],
						 'nome' => $key['nome']);
	}
	echo json_encode($dados);
}else{
	echo 0;
}
?>