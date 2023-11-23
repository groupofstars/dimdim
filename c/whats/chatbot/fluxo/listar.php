<?php
include "../../conn.php";

$id = $_POST['id'];

$bot = $pdo->query("SELECT * FROM chatbot WHERE id = '$id'");
foreach($bot as $key){
	$hash = $key['hash'];
	$instancia = $key['instancia'];
	$word = $key['pergunta'];
} 


$all_bots = $pdo->query("SELECT * FROM chatbot_responde WHERE instancia = '$instancia' AND hash = '$hash' ORDER BY posicao");

if($all_bots->rowCount() > 0){
	foreach($all_bots as $key){
		$mybots[] = array('id' => $key['id'],
						  'tipo' => $key['tipo'],
						  'texto' => $key['texto'],
						  'midia' => $key['midia'],
						  'posicao' => $key['posicao']);
	}
}else{
	$mybots = 0;
}

$dados = array('pergunta' => $word, 'bots' => $mybots, 'instancia' => $instancia);

echo json_encode($dados);
?>