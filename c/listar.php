<?php
include "../whats/conn.php";

$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();


/*Calculando o total da fatura*/
$valorTotal = 0;
$instancias = $pdo->query("SELECT * FROM nums WHERE owner = '$owner'");
$valorInstancia = $pdo->query("SELECT valor FROM functions WHERE id_item = 'instance'")->fetchColumn();


foreach($instancias as $key){
    $num = $key['num'];

    /*Isnerindo o valor das instancias*/
    $valorTotal = $valorTotal+$valorInstancia;
    /*Inserindo o valor das instancias*/


    /*Buscando os itens das instancias*/
    
    $itens = $pdo->query("SELECT * FROM myplan WHERE instance = '$num'");
    if($itens->rowCount() > 0){
        foreach($itens as $key){
            $item = $key['item'];
            $valorItem = $pdo->query("SELECT valor FROM functions WHERE id_item = '$item'")->fetchColumn();
            $valorTotal = $valorTotal+$valorItem;
        }
    }
    /*Buscabdo os itens das instancias*/
}





/*Planos cancelados*/
$diePlans = $pdo->query("SELECT * FROM diplan WHERE user = '$owner'");

if($diePlans->rowCount() > 0){
	
	foreach($diePlans as $key){
		$item = $key['item'];
		$dias = $key['dias'];
		$valorItem = $pdo->query("SELECT valor FROM functions WHERE id_item = '$item'")->fetchColumn();
		$valorDiario = $valorItem/30;
		$calculo = $valorDiario*$dias;
		$valorTotal = $valorTotal+$calculo;
	}
}
/*Planos cancelados*/


/*Formatando o total*/
$valorTotal = number_format($valorTotal, 2, '.', '');
/*Formatando o total*/

/*Calculando o total da fatura*/


$faturas = $pdo->query("SELECT * FROM mensalidades WHERE user = '$owner' ORDER BY id DESC");
if($faturas->rowCount() > 0){
	foreach($faturas as $key){
		$pagamento = $key['status'];

		/*Calculando vencimento com prazo de carencia*/
		$data = $key['data'];
		$carencia = 10; //Dias de carencia após o prazo
		$vencimento =  new DateTime($data);
		$vencimento->modify('+' . $carencia . ' days');
		$vencimentoFormat = $vencimento->format('d-m-Y');
		/*Calculando vencimento com prazo de carencia*/

		/*Definindo o status*/
		$hoje = new DateTime();
		$dataBanco = new DateTime($data);

		if($pagamento == 0){
			if($hoje < $dataBanco){
				$status = "emdia";
			}else if($hoje > $dataBanco){
				 $diferenca = $hoje->diff($dataBanco);
				 $diasPassados = $diferenca->days;

				 if ($diasPassados <= 10) {
				    $status = "atrasada";
				 } else {
				    $status = "vencida";
				 }
			}else{
				$status = 'emdia';
			}
		}else if($pagamento == 1){
			$status = 'pago';
		}
		/*Definindo o status*/
		$dados[] = array('id' => $key['id'],
						 'vencimento' => $vencimentoFormat,
						 'status' => $status,
						 'valor' => $valorTotal);
	}

	echo json_encode($dados);
}else{
	echo 0;
}
?>