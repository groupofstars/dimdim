<?php
include "../whats/conn.php";

/*Dados*/
$id = "4";//$_POST['id'];
$url_retorn = "http://dimdimbet.com/";

$all = $pdo->query("SELECT * FROM mensalidades WHERE id = '$id'");
foreach($all as $key){
    $hash = $key['hash'];
    $owner = $key['user'];
}
/*Dados*/



// SDK do Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

/*Credenciais*/
$token = $pdo->query("SELECT access_token FROM all_configs")->fetchColumn();
/*Credenciais*/


MercadoPago\SDK::setAccessToken($token);


// Cria um objeto de preferência
$preference = new MercadoPago\Preference();

$payment = new MercadoPago\Payment();



/*Habilitando o pix*/
$preference->payment_methods = array(
    "excluded_payment_methods" => array(),
    "excluded_payment_types" => array(),
    "default_payment_method_id" => null,
    "installments" => 1,
    "pix" => array(
        "enabled" => true
    )
);
/*Habilitando o pix*/




/*Auto retorno (nunca funcionou kkk)*/
$preference->auto_return = "approved";
/*Auto retorno (nunca funcionou kkk)*/

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




/*Item na preferencia (Não faço ideia do pq do nome)*/
$item = new MercadoPago\Item();
$item->id = $hash;
$item->title = 'FATURA WORDSYSTEM';
$item->quantity = 1;
$item->unit_price = $valorTotal;
$preference->items = array($item);
$preference->payment = array($payment);
$preference->save();
/*Item na preferencia (Não faço ideia do pq do nome)*/

/*Id do retorno pra criar o link de pagamento*/
$pid = $preference->id;
/*Id do retorno pra criar o link de pagamento*/


 /*Url de retorno*/
    $preference->back_urls = array(
        "success" => $url_retorn,
        "failure" => $url_retorn,
        "pending" => $url_retorn
    );
/*Url de retorno*/

if($pid){
    /*Update no banco de dados*/
    //$pdo->query("UPDATE mensalidades SET pid = '$pid' AND user = '$owner'");
    /*Update no banco de dados*/
}else{
    //echo "nada";
    //var_dump($preference);
}

var_dump($preference);


?>