<?php
include "../conn.php";

$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$nums = $pdo->query("SELECT * FROM nums WHERE owner = '$owner'");

if($nums->rowCount() > 0){
	foreach($nums as $n){
		$num = $n['num'];

		$reply = $pdo->query("SELECT * FROM reply WHERE num = '$num'");
		if($reply->rowCount() > 0){


			foreach($reply as $r){
				$dados[] = array('id' => $r['id'],
								 'num' => $r['num'],
								 'pergunta' => $r['pergunta'],
								 'tipo' => $r['responde']); 
			} 
			
			echo json_encode($dados);
		}else{

		}
	}

	

}else{
	echo 0;
}
?>