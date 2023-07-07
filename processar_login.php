<?php
session_start(); // Inicia a sessão
include "config.php";

// Verifica se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtém os dados do formulário
  $email = $_POST["email"];
  $senha = $_POST["senha"];
  var_dump($email, $senha);

  // Verifica se o e-mail e a senha são válidos (exemplo simplificado)
  if ($email == "usuario@email.com" && $senha == "senha123") {
    // Autenticação bem-sucedida, redireciona para a página inicial
    header("Location: lugares.php");
    exit;
  } else {
    // Autenticação falhou, exibe uma mensagem de erro
    echo "E-mail ou senha inválidos.";
  }
}
?>
