<?php

include "../conn.php";

$options = array('http' => array(
	'method' => 'GET',
	'header' => 'Authorization: Bearer 123'
));

$context = stream_context_create($options);  

$qrcode = file_get_contents($url."/instance/qrbase64?key=".$hash, false, $context);

$qrcode =  json_decode($qrcode, true);

sleep(1);

if($qrcode['qrcode'] != ''){
  echo $qrcode['qrcode'];
}else{
	echo 0;
}
?>