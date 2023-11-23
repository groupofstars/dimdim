<?php
include "../../conn.php";

$ips = $pdo->query("SELECT * FROM block_ip ORDER BY id DESC");
if($ips->rowCount() > 0){
	foreach($ips as $ip){
		$dados[] = array('ip' => $ip['ip']);
	}

	echo json_encode($dados);
}else{
	echo 0;
}

?>