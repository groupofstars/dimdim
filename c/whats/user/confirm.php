<?php
include "../conn.php";

$cod = $_POST['cod'];
$num = $_POST['num'];


$v = $pdo->query("SELECT * FROM confirm_num WHERE num = '$num'");
if($v->rowCount() > 0){
	foreach($v as $k){
		$user = $k['user'];
		if($k['codigo'] == $cod){
			$pdo->query("UPDATE users SET contato = '$num' WHERE id = '$user'");
			echo 1;
		}else{
			echo 0;
		}
	}
}else{
	echo 0;
}
?>