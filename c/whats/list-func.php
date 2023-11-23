<?php
include "conn.php";

$filtro = @$_POST['filtro'];

if($filtro == '' || $filtro == '5'){
	$listar = $pdo->query("SELECT * FROM func ORDER BY id DESC");
}else{
	$listar = $pdo->query("SELECT * FROM func WHERE status = '$filtro' ORDER BY id DESC ");
}



if($listar->rowCount() > 0){

	foreach($listar as $k){
		$dados[] = array('id' => $k['id'],
						 'funcao' => $k['funcao'],
						 'valor' => $k['valor'],
						 'status' => $k['status'],
						 'pago' => $k['pago']);
	}


	echo json_encode($dados);

}else {
	echo 0;
}
?>