<?php
include "../../../conn.php";

$data = @$_POST['data'];
$quantidade = $_POST['quantidade'];

if($data != ''){
	
	$dados = $pdo->query("SELECT * FROM solicita_saque WHERE DATE_FORMAT(data, '%Y-%m-%d') = '$data' AND status = '1' ORDER BY id DESC LIMIT $quantidade");
}else{
	$dados = $pdo->query("SELECT * FROM solicita_saque   WHERE status = '1' ORDER BY id DESC LIMIT $quantidade ");
	

}


if($dados->rowCount() > 0){
	foreach($dados as $key){
		$id = $key['user'];
		$nome = $pdo->query("SELECT nome FROM users WHERE id = '$id'")->fetchColumn();

		$valor = $key['valor'];
		$valor = 'R$ ' .number_format($valor,  2, ',', '.');
		$d[] = array('id' => $key['id'],
						'nome' => $nome,
						'valor' => $valor,
						'status' => $key['status'],
						'data' => $key['data']);

	}

	echo json_encode($d);
}else{
	echo 0;
}



?>