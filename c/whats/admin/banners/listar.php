<?php
include "../../conn.php";

$listar = $pdo->query("SELECT * FROM banners ORDER BY posicao ASC");

if($listar->rowCount() > 0){
	foreach($listar as $key){
		$dados[] = array('id' => $key['id'],
						 'img' => $key['img']);
	}

	echo json_encode($dados);
}else{
	echo 0;
}
?>