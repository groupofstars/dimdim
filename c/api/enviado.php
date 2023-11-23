<?php
$insere = $pdo->query("INSERT INTO envios (user, data, lista, email) VALUES ('$owner', '$hoje', '$lista' , '$id_email')");


$owner = $pdo->query("SELECT owner FROM listas WHERE id = '$lista'")->fetchColumn();

//Creditos
    $creditos = $pdo->query("SELECT saldo FROM users WHERE id = '$owner'")->fetchColumn();
    $desconta = $creditos-0.2;

    $atualiza = $pdo->query("UPDATE users SET saldo = '$desconta' WHERE id = '$owner'");

$dados = array('status'=> 1,
                       'email' => $email,
                       'cliente' => $cliente);
        echo json_encode($dados);
?>
