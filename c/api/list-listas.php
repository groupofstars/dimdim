<?php
include "conn.php";

$user = $_POST['user'];
$owner = $pdo->query("SELECT id FROM users WHERE email = '$user'")->fetchColumn();
$lista = @$_POST['lista'];
if(isset($lista)){
  $listas = $pdo->query("SELECT * FROM listas WHERE owner = '$owner' AND nome LIKE '%$lista%'");
}else{
  $listas = $pdo->query("SELECT * FROM listas WHERE owner = '$owner'");
}
if($listas->rowCount() > 0){
	echo "<thead>
              <tr>
                  <th></th>
                  <th>Nome</th>
                  <th>Total Emails</th>
                  <th>Envios</th>
                  <th>Ações</th>
              </tr>
          </thead><tbody>";
	
	foreach ($listas as $key) {
		$id_lista = $key['id'];

		$emails_total = $pdo->query("SELECT count(id) FROM emails WHERE lista = '$id_lista'")->fetchColumn();
		$envios_total = $pdo->query("SELECT count(id) FROM  envios WHERE lista = '$id_lista'")->fetchColumn();

		echo '
              <tr>
                  <td></td>
                  <td>'.$key['nome'].'</td>
                  <td><span class="badge badge-success">'.$emails_total.'</span></td>
                  <td><span class="badge badge-success">'.$envios_total.'</span></td>
                  <td>
                    <button class="btn btn-info btn-sm" onclick="addemails('.$key['id'].')">
                      <i class="fas fa-user-plus"></i>
                    </button>
                    <button class="btn btn-success btn-sm" onclick="sendmessage('.$key['id'].')">
                      <i class="fas fa-envelope"></i>
                    </button>
                 
                     <button class="btn btn-danger btn-sm" onclick="deleta('.$key['id'].')">
                      <i class="fas fa-trash"></i>
                    </button>

                  </td>
              </tr>';
	}

	echo "</tbody>";
}else{
	echo "<div class='container text-center mt-3 mb-3'>Nenhuma lista encontrada!</div>";
}
?>