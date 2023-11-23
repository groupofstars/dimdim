<?php
include "../../conn.php";
$user = $_POST['user'];

$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$listar = $pdo->query("SELECT * FROM etapas_task WHERE user = '$owner' ORDER BY id ASC");

if($listar->rowCount() > 0){
	foreach($listar as $k){

		$etapa = $k['id'];
		$tasks_list = array();
		$tasks = $pdo->query("SELECT * FROM list_task WHERE etapa = '$etapa' ORDER BY id ASC");

			if($tasks->rowCount() > 0){
				foreach($tasks as $key){
				$tasks_list[] = array('id' => $key['id'],
									  'tarefa' => $key['tarefa'],
									  'status' => $key['status'],
									  'prioridade' => $key['prioridade']);
				}
			}else{
				$tasks_list = 0;
			}	
		
		

		$dados[] = array('id' => $k['id'],
						 'nome' => $k['nome'],
						 'tasks' => $tasks_list);
	}

	echo json_encode($dados);
}else{
	echo 0;
}
?>