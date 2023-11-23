<?php
date_default_timezone_set('America/Sao_Paulo');


$url = "http://127.0.0.1:3333";
$path = "http://dimdimbet.com/c/whats/images/";

try {
$pdo = new PDO('mysql:host=localhost;dbname=admin;charset=utf8mb4','admin', 'dZ3ed6hmdHkFjEjc',
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	//echo "Conexão estabelecida";
}
catch(PDOException $ex){
	echo "Erro ao estabelecer conexão => ".$ex;
}



?>
