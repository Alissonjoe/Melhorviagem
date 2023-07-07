<?php
session_start()
include "conexao.php";
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores enviados pelo formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Validação dos dados (pode ser adicionada mais validação aqui)

    // Conexão com o banco de dados
    $conexao = new mysqli($servername, $username, $password, $dbname);

    // Verifica se ocorreu algum erro na conexão
    if ($conexao->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
    }

    // Verifica se o e-mail já está cadastrado no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    
    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt) {
        // Vincula o parâmetro da consulta
        $stmt->bind_param("s", $email);
        
        // Executa a consulta
        $stmt->execute();
        
        // Obtém o resultado da consulta
        $result = $stmt->get_result();
        
        // Verifica se o e-mail já está cadastrado
        if ($result->num_rows > 0) {
            $erro = "O e-mail fornecido já está cadastrado.";
        } else {
            // Insere os dados do usuário no banco de dados
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = $conexao->prepare($sql);
            
            // Verifica se a preparação da consulta foi bem-sucedida
            if ($stmt) {
                // Criptografa a senha antes de armazenar no banco de dados
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                
                // Vincula os parâmetros da consulta
                $stmt->bind_param("sss", $nome, $email, $senhaHash);
                
                // Executa a consulta
                if ($stmt->execute()) {
                    // Cadastro bem-sucedido, redireciona para a página de lugares
                    header("Location: lugares.php");
                    exit;
                } else {
                    // Se houver erro na execução da consulta, exibe mensagem de erro
                    $erro = "Erro ao cadastrar o usuário: " . $stmt->error;
                }
                
                // Fecha a consulta
                $stmt->close();
            } else {
                // Se houver erro na preparação da consulta, exibe mensagem de erro
                $erro = "Erro ao preparar a consulta: " . $conexao->error;
            }
        }
        
        // Fecha a consulta
        $stmt->close();
    } else {
        // Se houver erro na preparação da consulta, exibe mensagem de erro
        $erro = "Erro ao preparar a consulta: " . $conexao->error;
    }
    
    // Fecha a conexão com o banco de dados
    $conexao->close();
}
?>

<!-- HTML do formulário -->
<form action="cadastro.php" method="POST">
  <!-- Campos do formulário -->
</form>
<form action="cadastro.php" method="POST">
 <!-- HTML do formulário de cadastro -->
<form action="processar_cadastro.php" method="POST">
  <label for="nome">Nome:</label>
  <input type="text" name="nome" id="nome" required>
  
  <label for="email">E-mail:</label>
  <input type="email" name="email" id="email" required>
  
  <label for="senha">Senha:</label>
  <input type="password" name="senha" id="senha" required>
  
  <button type="submit">Cadastrar</button>
</form>

</form>
