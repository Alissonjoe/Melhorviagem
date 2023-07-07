<?php
$servername = "localhost"; // Ou o endereço IP do servidor MySQL, se for diferente
$username = "root"; // O nome de usuário do MySQL (por padrão, é "root" no XAMPP)
$password = ""; // A senha do MySQL (por padrão, é vazio no XAMPP)
$dbname = "melhor_viagem"; // O nome do banco de dados que você criou

// Cria a conexão
$conexao = mysqli_connect($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida corretamente
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>
