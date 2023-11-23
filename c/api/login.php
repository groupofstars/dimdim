<?php
include "conn.php";

$email = $_POST['email'];
$senha = $_POST['senha'];


	$login = $pdo->query("SELECT status FROM users WHERE email = '$email' AND senha = '$senha'")->fetchColumn();

	if($login > 0){
		echo 1;
	}else{
		echo 0;
	}
	

?>