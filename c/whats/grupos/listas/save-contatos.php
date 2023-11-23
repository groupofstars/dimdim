<?php
include "../../conn.php";

$lista = $_POST['lista'];
$contato = $_POST['num'];


$pdo->query("INSERT INTO save_contatos (contato, lista) VALUES ('$contato', '$lista')");

echo 1;

?>