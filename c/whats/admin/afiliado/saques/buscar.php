<?php
include "../../../conn.php";

$id = $_POST['id'];

$dados = $pdo->query("SELECT * FROM solicita_saque WHERE id = '$id'");
foreach($dados as $key){
	$user = $key['user'];
	$nome = $pdo->query("SELECT nome FROM users WHERE id = '$user'")->fetchColumn();
	$valor = $valor = 'R$ ' .number_format($key['valor'],  2, ',', '.');
	$conta = $key['conta'];
	$pix = $pdo->query("SELECT pix FROM contas_bancarias WHERE id = '$conta'")->fetchColumn();

	$data = array('nome' => $nome,
				  'valor' => $valor,
				  'pix' => $pix);
}

echo json_encode($data);

?>