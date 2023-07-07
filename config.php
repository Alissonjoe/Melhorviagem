<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "melhor_viagem";

// Cria a conexão
$conexao = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida corretamente
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>
