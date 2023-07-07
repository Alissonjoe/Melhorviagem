<?php
session_start(); // Inicia a sessão
include "conexao.php";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores enviados pelo formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Conexão com o banco de dados
    $conexao = new mysqli($servername, $username, $password, $dbname);

    // Verifica se ocorreu algum erro na conexão
    if ($conexao->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
    }

    // Prepara a consulta SQL para buscar o usuário com o e-mail fornecido
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conexao->query($sql);

    // Verifica se o usuário foi encontrado
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Verifica se a senha fornecida corresponde à senha armazenada no banco de dados
        if ($senha == $row["senha"]) {
            // Autenticação bem-sucedida
            // Define os dados do usuário na sessão
            $_SESSION["usuario"] = $row["email"];
            $_SESSION["nome"] = $row["nome"];
            
            // Redireciona para a página após o login bem-sucedido
            header("Location: lugares.php");
            exit;
        } else {
            // Senha inválida
            echo "E-mail ou senha inválidos.";
        }
    } else {
        // Usuário não encontrado
        echo "E-mail ou senha inválidos.";
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();
}
?>
