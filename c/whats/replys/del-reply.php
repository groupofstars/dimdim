<?php
include "../conn.php";

$reply =  $_POST['reply'];

$r = $pdo->query("SELECT * FROM reply WHERE id = '$reply'");

foreach($r as $k){
	$hash = $k['hash'];
	$tipo = $k['responde'];
}


	if($tipo == 'button'){
		$db = $pdo->query("DELETE FROM reply_button WHERE hash = '$hash'");
		$db = $pdo->query("DELETE FROM buttons WHERE hash = '$hash'");
	}else if($tipo == 'midia'){
		$db = $pdo->query("DELETE FROM reply_midia WHERE hash = '$hash'");
	}else if($tipo == 'texto'){
		$db = $pdo->query("DELETE FROM reply_text  WHERE hash = '$hash'");
	}else if($tipo == 'midia-button'){
		$db = $pdo->query("DELETE FROM reply_midia_button WHERE hash = '$hash'");
		$db = $pdo->query("DELETE FROM buttons WHERE hash = '$hash'");

	}else if($tipo == 'lista'){
		$db = $pdo->query("DELETE FROM reply_lista WHERE hash = '$hash'");
		$db = $pdo->query("DELETE FROM row_list WHERE hash = '$hash'");
	}

$delreply = $pdo->query("DELETE FROM reply WHERE hash = '$hash'");

echo 1;
?>