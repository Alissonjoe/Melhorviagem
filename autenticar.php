<?php
include "conexao.php";
    session_start();

    // Conectar ao banco de dados
    $servername = "localhost";
    $username = "seu_usuario";
    $password = "sua_senha";
    $dbname = "nome_do_banco_de_dados";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
    }

    // Obter os dados do formulário de login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consultar o banco de dados para verificar se o usuário existe
    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuário autenticado, redirecionar para a página de lugares
        $_SESSION['username'] = $username;
        header("Location: lugares.php");
        exit();
    } else {
        // Usuário não autenticado, redirecionar para a página de login novamente
        header("Location: login.php");
        exit();
    }

    $conn->close();
?>
