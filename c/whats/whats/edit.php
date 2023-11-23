<?php
include "../conn.php";
$dados = json_decode(file_get_contents('php://input'), false);

$id = $dados->id;

$instance = $pdo->query("SELECT num FROM nums WHERE id = '$id'")->fetchColumn();

$nome = $dados->nome;

$owner = $pdo->query("SELECT owner FROM nums WHERE id = '$id'")->fetchColumn();

$itens = $dados->itens;

$hoje = date('Y-m-d');


  /*Comparativo de datas pro proximo pagamento*/
    $exp = $pdo->query("SELECT expira FROM users WHERE id = '$owner'")->fetchColumn();
    $verificaMensalidade = $pdo->query("SELECT * FROM mensalidades WHERE data > '$hoje' AND user = '$owner'");

   if(strtotime($exp) > strtotime($hoje)){
     if($verificaMensalidade->rowCount() > 0){
        $proxMes = date('Y-m-d', strtotime('+1 month', strtotime($exp)));
        $proxPay = date('Y-m-01', strtotime($proxMes));
        $pdo->query("UPDATE mensalidades SET data = '$proxPay' WHERE user = '$owner'");

       
    }else{

        $proxMes = date('Y-m-d', strtotime('+1 month', strtotime($exp)));
        $proxPay = date('Y-m-01', strtotime($proxMes));
        $pdo->query("INSERT INTO mensalidades (user, data, status) VALUES ('$owner', '$proxPay', '0')");
         
    }
}else if(strtotime($exp) < strtotime($hoje)){
    if($verificaMensalidade->rowCount() > 0){
        $proxMes = date('Y-m-d', strtotime('+1 month', strtotime($hoje)));
        $proxPay = date('Y-m-01', strtotime($proxMes));
        $pdo->query("UPDATE mensalidades SET data = '$proxPay' WHERE user = '$owner'");

        
    }else{

        $proxMes = date('Y-m-d', strtotime('+1 month', strtotime($hoje)));
        $proxPay = date('Y-m-01', strtotime($proxMes));
        $pdo->query("INSERT INTO mensalidades (user, data, status) VALUES ('$owner', '$proxPay', '0')");
         
    }
}
     /*Comparativo de datas pro proximo pagamento*/
    



if($nome != ''){
	//echo "Editando nome: $nome<br>";
	$pdo->query("UPDATE nums SET nome = '$nome' WHERE num = '$instance'");
}

foreach($itens as $key){
	$item = $key->item;
	$status = $key->status;

	if($status == 'false'){

		$v = $pdo->query("SELECT data FROM myplan WHERE item = '$item' AND instance = '$instance'")->fetchColumn();

		if($v != 0){
			$hoje = new DateTime($hoje);
		    $dias = new DateTime($v);

		    $usados = $hoje->diff($dias);
		    $usadosFormat = $usados->format('%a');

		    if($usadosFormat > 0){
		    	$pdo->query("INSERT INTO diplan (dias, user, item) VALUES ('$usadosFormat','$owner', '$item')");
		    }
		    
      	    $pdo->query("DELETE FROM myplan WHERE instance = '$instance' AND item = '$item'");
    	    //echo "dias: $usadosFormat instance: $instance user: $owner<br>";
		}
		
	}else if($status == 'true'){
		  $v = $pdo->query("SELECT * FROM myplan WHERE instance = '$instance' AND item = '$item'");
	      if($v->rowCount() > 0){
	        //echo "Não faz nada: $item";
	      }else{
	        //echo "Insere novo: $item";
	        $pdo->query("INSERT INTO myplan (instance, item, data) VALUES ('$instance', '$item', '$hoje')");
	      }
	}

}
echo 1;

?>