<?php
include "../conn.php";

$id = $_POST['id'];

$instance = $pdo->query("SELECT * FROM nums WHERE id = '$id'");
foreach($instance as $key){
  $owner = $key['owner'];
  $hash = $key['num'];
  $data = $key['data'];
}

/*Quantidade de dias e horas usados*/
$hoje = date('Y-m-d H:i:s');
$cadastro = new DateTime($data);
$cancelamento = new DateTime($hoje);

$diferenca = $cancelamento->diff($cadastro);

$valorMensal = $pdo->query("SELECT valor FROM functions WHERE id_item = 'instance'")->fetchColumn();
$dias = $diferenca->days;
$hora = $diferenca->h;

$custoDia = $valorMensal/30;
$custoDia = $custoDia*$dias;
$custoHora = $hora == 0 ? 0 : $valorMensal/($hora*30);


$total = number_format($custoDia+$custoHora, 2);

$valor_corrigido = str_replace(',', '.', $total);
/*Quantidade de dias e horas usados*/


$pdo->query("INSERT INTO dieinstance (user, valor) VALUES ('$owner', '$valor_corrigido')");

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url.'/instance/delete?key='.$hash,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'DELETE',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer RANDOM_STRING_HERE'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

  $del = $pdo->query("DELETE FROM nums WHERE id = '$id'");
  echo 1;

?>
