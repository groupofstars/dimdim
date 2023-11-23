<?php
include "../conn.php";

$id = $_POST['id'];

$item  = $pdo->query("SELECT * FROM functions WHERE id = '$id'");
foreach($item as $key){
	$dados = array('id' => $key['id'],
				   'nome' => $key['nome'],
				   'valor' => $key['valor']);
}

echo json_encode($dados);

?>