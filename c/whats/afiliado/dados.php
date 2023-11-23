<?php 
include "../conn.php";

$user = $_POST['user'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();
$all = $pdo->query("SELECT * FROM users WHERE email = '$user'");

/*Porcentagem*/
$porcentagem = $pdo->query("SELECT porcentagem_afd FROM all_configs")->fetchColumn();
/*Porcentagem*/



/*Cliques no link*/
$enc = 'AFD-'.$owner;
$cliques = $pdo->query("SELECT cliques FROM enc_url WHERE enc = '$enc' AND owner = '$owner'")->fetchColumn();
/*Cliques no link*/

/*Users*/
$users = $pdo->query("SELECT count(id) FROM users WHERE afiliado = '$owner'")->fetchColumn();
/*Users*/

/*Verifica link*/
$v = $pdo->query("SELECT * FROM enc_url WHERE enc = '$enc'");
if($v->rowCount() > 0){

}else{
	$urlaf = "https://app.whatsafiliado.online/c/login/register.html?a=".$owner;
	$pdo->query("INSERT INTO enc_url (url, enc, cliques, owner) VALUES ('$urlaf', '$enc', '0', '$owner')");
}

/*Verifica link*/

/*Dados do afiliado*/
foreach($all as $key){

	$saldo = $key['saldo_afiliado'];
	$saque = $pdo->query("SELECT SUM(valor) FROM solicita_saque WHERE user = '$owner' AND  status = '1'")->fetchColumn();
	if($saque == null){
		$saque = 0;
	}
	$saldo = $saldo - $saque;

	$dados = array('id' => $key['id'],
				   'saldo' => $saldo,
				   'saque' => $saque,
				   'pixel' => $key['pixel_fb'],
				   'users' => $users,
				   'cliques' => $cliques,
				   'link' => 'http://whatsa.fun/AFD-'.$owner,
				   'porcentagem' => $porcentagem);
}
/*Dados do afiliado*/

echo json_encode($dados);
?>