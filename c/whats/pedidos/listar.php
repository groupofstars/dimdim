<?php
include "../conn.php";

$user = $_POST['user'];


$listar = $pdo->query("SELECT * FROM pedidos ORDER BY id DESC");

if($listar->rowCount() > 0){

	



	foreach($listar as $key){

		$id = $key['id'];

/*NOME DO USUARIO*/
	$id_user = $key['user'];
	$nome_user = $pdo->query("SELECT nome FROM users WHERE id = '$id_user'")->fetchColumn();
/*NOME DO USUARIO*/


/*BUSCANDO APOIOS*/
		$apoios = $pdo->query("SELECT count(id) FROM apoio WHERE pedido = '$id'")->fetchColumn();

		$i_liked = $pdo->query("SELECT count(id) FROM apoio WHERE pedido = '$id' AND user = $user")->fetchColumn();
/*BUSCANDO APOIOS*/

		


/*BUSCANDO COMENTATARIOS*/
		$comentarios = $pdo->query("SELECT * FROM respostas_pedidos WHERE pedido = '$id'");

		if($comentarios->rowCount() > 0){

			foreach($comentarios as $k){
				$id_user_resp = $k['user'];
				$nome_user_resp = $pdo->query("SELECT nome FROM users WHERE id = '$id_user_resp'")->fetchColumn();

				$coments[] = array('user' => $nome_user_resp,
								   'resposta' => $k['resposta'],
								   'data' => $k['data']);
			}
		}else{
			$coments = 0;

		}

		$total_coments = $comentarios->rowCount();
/*BUSCANDO COMENTATIOS*/


		$dados[] = array('id' => $id,
						 'user' => $nome_user,
						 'title' => $key['title'],
						 'pedido' => $key['pedido'],
						 'data' => $key['data'],
						 'status' => $key['status'],
						 'i_liked' => $i_liked,
						 'apoios' => $apoios,
						 'comentarios' => $coments,
						 'total_coments' => $total_coments);

	}





}else{
	echo 0;
}


?>