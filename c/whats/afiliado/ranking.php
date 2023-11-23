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

    $img = $pdo->query("SELECT image FROM users WHERE id = '$id_afiliado'")->fetchColumn();

    if($id_afiliado == $mid){
        $me = true;
        $minha_posicao = count($ranking) + 1;

        if($minha_posicao == ''){
            $minha_posicao = "Sem posição";
        }
    }else{
        $me = false;
        
    }
    if($row['afiliado'] != ''){
        $ranking[] = array('afiliado' => $nome_afd, 'img' => $img,'total_vendas' => $row['total_vendas'],  'me' => $me);
    }
}

echo json_encode(array('ranking' =>$ranking, 'position' => $minha_posicao."°"));

?>