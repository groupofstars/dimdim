<?php
include "conn.php";

$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();

$listar = $pdo->query("SELECT * FROM contas WHERE owner = '$owner'");

if($listar->rowCount() > 0){
	foreach ($listar as $key) {
		$id_email = $key['id'];
		$envios = $pdo->query("SELECT COUNT(id) FROM envios WHERE email = '$id_email'")->fetchColumn();

		echo '	<div class="col-12 col-md-4">
	         		<div class="card">
	         			<div class="card-body">
    	         			<div class="row">
    	         				<div class="col">
    	         					<strong>Email: </strong> '.$key['email'].'
    	         					<br>
    	         					<strong>Senha: </strong> <input type="password" value="'.$key['senha'].'" style="background-color: transparent;border: none;" disabled="">
    	         				</div>

    	         				<div class="col-auto mr-1">
    	         					<span onclick="del('.$key['id'].')" class="badge badge-danger" style="position: relative;top: -18px;left: 18px;padding: 5px;cursor: pointer;">
    	         						<i class="fas fa-trash"></i>
    	         					</span>
    	         				</div>

    	         			</div>
	         			</div>
                <div class="container text-right mb-2">
                  <span class="badge badge-danger">
                   	@'.$key['tipo'].'
                  </span>
                  <span class="badge badge-default">
                    '.$envios.'
                  </span>
                </div>
	         		</div>
	         	</div>';
	}


}else{
	echo "<div class='container text-center'>Você não possui contas de envio</div>";
}
?>