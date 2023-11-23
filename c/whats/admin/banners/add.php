<?php
include "../../conn.php";

if($_FILES['image']){
	 $directory = 'img/';
 $name = uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
  move_uploaded_file($_FILES['image']['tmp_name'], $directory . $name);

// Faz a consulta para obter a última posição
$sql = "SELECT MAX(posicao) AS ultima_posicao FROM banners";
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


  $pdo->query("INSERT INTO banners (img, posicao) VALUES ('$name', '$proxima_posicao')");
  
  echo 1;
}
?>