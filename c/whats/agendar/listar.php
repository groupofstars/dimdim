<?php
include "../conn.php";

$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();
$list = $pdo->query("SELECT * FROM agendar WHERE owner = '$owner'");

if($list->rowCount() > 0){
	foreach($list as $k){
		
		/*Lista*/
		$l = $k['lista'];
	    $lista = $pdo->query("SELECT nome FROM listas_wpp WHERE id = '$l'")->fetchColumn();
	    /*Lista*/

	    /*Lista contatos*/
	    $lc = $k['lista_contatos'];
	    $lista_contatos = $pdo->query("SELECT nome FROM lista_contatos WHERE id = '$lc'")->fetchColumn();
	    /*Lista contatos*/

		$dados[] = array('id' => $k['id'],
						 'lista' => $lista,
						 'lista_contatos' => $lista_contatos,
						 'data' => $k['data'],
						 'status' => $k['status']);
	}

	echo json_encode($dados);
}else {
	echo 0;
}
?>