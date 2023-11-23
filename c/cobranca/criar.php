<?php
include "../whats/conn.php";


// SDK do Mercado Pago
require  '../mp/vendor/autoload.php';

// Adicione as credenciais
MercadoPago\SDK::setAccessToken('APP_USR-745174516239038-021516-4fa359c8c390bec5cd5e9945525479e9-378670803');

$dados = json_decode(file_get_contents('php://input'), false);

/*Buscando dados do usuário*/
$user = $dados->user;

$dados_user = $pdo->query("SELECT * FROM users WHERE id = '$user'");
foreach($dados_user as $u){
	$nome = $u['nome'];
	$contato = $u['contato'];
	$exp = date('d/m', strtotime($u['expira']));
	$plano = $u['plano'];
}
/*Buscando dados do usuário*/

/*Alternando valor entre planos*/
if($plano == 1){
	$preco = 97;
}else if($plano == 2){
	$preco = 147;
}else if($plano == 3){
	$preco = 247;
}else{
	$preco = 97;
}
/*Alternando valor entre planos*/


/*Verificar as configurações do sistema*/
$config = $pdo->query("SELECT * FROM config_cobranca");
foreach($config as $c){
	$message = $c['mensagem'];
	$link = $c['link'];
	$instancia = $c['instancia'];
	$onn = $c['status'];
}
/*Verificar as configurações do sistema*/
if($contato != ""){
/*Verificando a habilitação*/
if($link == 'true'){

	/*Criando pagamento*/
		$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
		$enc = "PAG-".substr(str_shuffle($string), 0, 6).$user;

		// Cria um objeto de preferência
		$preference = new MercadoPago\Preference();
		// Cria um item na preferência
		$item = new MercadoPago\Item();
		$item->id = $enc;
		$item->title = 'Renovação do Plano';
		$item->quantity = 1;
		$item->unit_price = $preco;
		$preference->items = array($item);
		$preference->save();

		$link_mp = $preference->init_point;
		$link_pay = "http://whatsa.fun/".$enc;
		$pid = $preference->id;
		$pdo->query("INSERT INTO enc_url (url, enc, cliques, owner) VALUES ('$link_mp', '$enc', '0', '0')");
		
	/*Criando pagamento*/


}else{
	//echo 0;
}
/*Verificando a habilitação*/


/*Formatando a mensagem*/
$message = str_replace('{nome}', $nome, $message);
$message = str_replace('{link}', $link_pay, $message);
$message = str_replace('{exp}', $exp, $message);

/*Formatando a mensagem*/




/*Verificando se o robo esta ligado*/
if($onn == "true"){

/*Enviando mensagem ao cliente*/
$urll = 'http://127.0.0.1:3333/message/text?key='.$instancia.'&id='.$contato;
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => $urll,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_POSTFIELDS => 'id='.$contato.'&message='.$message,
	 
	CURLOPT_HTTPHEADER => array(
	    'Authorization: Bearer 123'
	  ),
	));

	$response = curl_exec($curl);
	curl_close($curl);
	$response = json_decode($response, true);
	$status = $response['data']['status'];



if($status == 'PENDING'){
	$data = date('Y-m-d');

	$pdo->query("INSERT INTO pagamentos (user, valor, data, status, hash, p_id, tipo) VALUES ('$user', '$preco', '$data', '0', '$enc', '$pid', '2')");


	$resp = array('para' => $contato,
				  'instance' => $instancia,
				  'msg' => $message);

	echo json_encode($resp);
	

	
}else{
	echo "erro";
}
/*Enviando mensagem ao cliente*/

}else{
	echo 0;
}
/*Verificando se o robo esta ligado*/
}else{
    echo "sem contato";
}
?>