<?php
include "../../conn.php";

$id = $_POST['id'];


$all = $pdo->query("SELECT * FROM chatbot WHERE id = '$id'");
foreach($all as $key){
	$instancia = $key['instancia'];
	$hash = $key['hash'];
}


// Faz a consulta para obter a última posição
$sql = "SELECT MAX(posicao) AS ultima_posicao FROM chatbot_responde WHERE hash = '$hash' AND instancia = '$instancia'";
$resultado = $pdo->query($sql);
$linha = $resultado->fetch(PDO::FETCH_ASSOC);

// Verifica se há algum resultado e define a próxima posição
if ($linha['ultima_posicao'] === null) {
    // Se não houver nenhum registro na tabela, a próxima posição será 1
    $proxima_posicao = 1;
} else {
    // Se houver registros na tabela, adiciona 1 à última posição para obter a próxima posição
    $proxima_posicao = $linha['ultima_posicao'] + 1;
}

//echo "posicao $proxima_posicao instancia $instancia hash $hash";

if($_FILES['audio']){
	$directory = '../../images/';
 	$name = "audio-".uniqid() . '.' . pathinfo($_FILES['audio']['name'], PATHINFO_EXTENSION);
  move_uploaded_file($_FILES['audio']['tmp_name'], $directory . $name);
}


$insere = $pdo->query("INSERT INTO chatbot_responde (tipo, midia, instancia, posicao, hash) VALUES ('audio', '$name', '$instancia', '$proxima_posicao', '$hash')");

$rowCount = $insere->rowCount();
if($rowCount > 0){
	echo 1;
}else{
	echo 0;
}

?>