<?php
include "../conn.php";

$user = $_POST['user'];

// Consulta SQL para contar o número de vendas por afiliado
$sql = "SELECT afiliado, COUNT(*) AS total_vendas
        FROM pagamentos WHERE status = 1
        GROUP BY afiliado

        ORDER BY total_vendas DESC";

// Executa a consulta SQL
$stmt = $pdo->prepare($sql);
$stmt->execute();

$mid = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();




// Cria um array de ranking de afiliados
$ranking = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id_afiliado = $row['afiliado'];

    
    $nome_afd = $pdo->query("SELECT nome FROM users WHERE id = '$id_afiliado'")->fetchColumn();

    if($id_afiliado == $mid){
        $minha_posicao = count($ranking) + 1;
    }else{
        $minha_posicao = "Sem posição";
    }

    if($row['afiliado'] != ''){
        $ranking[] = array('afiliado' => $nome_afd);
    }
  
}
$soma = $pdo->query("SELECT SUM(valor) FROM pagamentos WHERE afiliado = '$mid' AND status = '1'")->fetchColumn();

$faturamento = 'R$ ' . number_format($soma, 2, ',', '.');

echo json_encode(array('total' => $faturamento,'position' => $minha_posicao."°"));

/*
$mid = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

*/






?>