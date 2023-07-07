<?php
include "conexao.php";

// Verifica se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Insere os dados do novo usuário na tabela "usuarios"
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    // Executa a consulta
    if ($conexao->query($sql) === TRUE) {
        // Cadastro bem-sucedido, redireciona para a página de lugares
        header("Location: lugares.php");
        exit();
    } else {
        // Se houver erro na inserção, exibe mensagem de erro
        echo "Erro ao cadastrar o usuário: " . $conexao->error;
    }
}
?>

<!-- HTML do formulário -->
<form action="processar_cadastro.php" method="POST">
  <!-- Campos do formulário -->
</form>
