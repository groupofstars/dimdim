<?php
include "../conn.php";

$user = $_POST['user'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$listas = $pdo->query("SELECT * FROM noticias WHERE owner = '$owner'");

if($listas->rowCount() > 0){
	foreach($listas as $key){
		$hash = $key['grupo'];
		$p1 = $pdo->query("SELECT count(*) FROM listas_noticia WHERE grupo = '$hash'")->fetchColumn();

		$p2 = $pdo->query("SELECT count(*) FROM listas_noticia WHERE grupo = '$hash' AND status = '1'")->fetchColumn();
		$idlista = $key['id'];
		$contatos = $pdo->query("SELECT count(id) FROM leads_noticia WHERE id_lista = '$idlista'")->fetchColumn();
	
		$dados[] = array('id' => $key['id'],
						 'create' => $key['nome'],
						 'p2' => $p2,
						 'p1' => $p1,
						 'contatos' => $contatos);
	}

	echo json_encode($dados);
}else{
	echo 0;
}
?>