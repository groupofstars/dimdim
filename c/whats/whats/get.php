<?php
include "../conn.php";
$id = $_POST['id'];

$instance = $pdo->query("SELECT num FROM nums WHERE id = '$id'")->fetchColumn();
$nome = $pdo->query("SELECT nome FROM nums WHERE id = '$id'")->fetchColumn();
$all = $pdo->query("SELECT * FROM myplan WHERE instance = '$instance'");
$total = $pdo->query("SELECT valor FROM functions WHERE id_item = 'instance'")->fetchColumn();
if($all->rowCount() > 0){
	
	foreach($all as $key){
		$item = $key['item'];
		$plano[] = array('item' => $item);
	}

	$dados = array('status'=> 1,'itens' => $plano, 'total' => $total, 'nome' => $nome);
	echo json_encode($dados);
}else{
	echo json_encode(array('status'=> 0, 'total' => $total,'nome' => $nome));
}


?>