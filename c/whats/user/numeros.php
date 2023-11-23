<?php
include "../conn.php";

$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn(); 
$nums= $pdo->query("SELECT * FROM nums WHERE owner = '$owner' AND status = '1'");

foreach($nums as $k){
	$dados[] = array('nome' => $k['nome'],
					 'num' => $k['num']);
}

echo json_encode($dados);
?>