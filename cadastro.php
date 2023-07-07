<?php
include "conexao.php";
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtém os valores enviados pelo formulário
  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $senha = $_POST["senha"];

  // Validação dos dados (pode ser adicionada mais validação aqui)

  // Conexão com o banco de dados
  $host = "127.0.0.1";
  $usuario = "root";
  $senha_bd = "Filme@300";
  $banco = "nome_do_banco"; // Substitua pelo nome do seu banco de dados

  $conexao = mysqli_connect($host, $usuario, $senha_bd, $banco);

  // Verifica se a conexão foi estabelecida com sucesso
  if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
  }

  // Insere os dados do usuário no banco de dados
  $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

  if (mysqli_query($conexao, $sql)) {
    echo "Usuário cadastrado com sucesso!";
  } else {
    echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
  }

  // Fecha a conexão com o banco de dados
  mysqli_close($conexao);
}
?>
