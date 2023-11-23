<?php
include "../conn.php";

$contato = $_POST['id'];
$dados = $pdo->query("SELECT * FROM leads WHERE id = '$contato'");

foreach($dados as $key){
	$dados = array('id' => $key['id'],
				   'nome' => $key['nome'],
				   'numero' => $key['num'],
				   'email' => $key['email'],
				   'status' => $key['status']);
}

echo json_encode($dados);
?>