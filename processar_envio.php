<?php
session_start(); // Inicia a sessão
include "config.php";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Verifica se todos os campos foram preenchidos
  if (isset($_FILES["foto"]["tmp_name"]) && !empty($_FILES["foto"]["tmp_name"]) &&
      isset($_POST["Lugar"]) && !empty($_POST["Lugar"]) &&
      isset($_POST["dica"]) && !empty($_POST["dica"])) {

    // Configurações da imagem redimensionada
    $novaLargura = 600;
    $novaAltura = 400;
    $pastaUploads = 'uploads/'; // Pasta onde as imagens serão salvas

    // Move o arquivo enviado para o destino temporário
    $caminhoTemporario = $_FILES["foto"]["tmp_name"];
    $infoImagem = getimagesize($caminhoTemporario);

    // Verifica se o arquivo enviado é uma imagem
    if ($infoImagem !== false) {
      // Obtém a extensão do arquivo
      $extensao = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);

      // Cria um nome único para a imagem
      $nomeImagem = uniqid('imagem_') . '.' . $extensao;

      // Caminho completo para a imagem no diretório de uploads
      $caminhoDestino = $pastaUploads . $nomeImagem;

      // Carrega a imagem usando a biblioteca GD
      if ($extensao == "jpg" || $extensao == "jpeg") {
        $imagem = imagecreatefromjpeg($caminhoTemporario);
      } elseif ($extensao == "png") {
        $imagem = imagecreatefrompng($caminhoTemporario);
      } elseif ($extensao == "gif") {
        $imagem = imagecreatefromgif($caminhoTemporario);
      } else {
        // Se a extensão não for suportada, redirecione de volta para o formulário
        header("Location: lugares.php");
        exit;
      }

      // Obtém as dimensões atuais da imagem
      list($larguraAtual, $alturaAtual) = $infoImagem;

      // Cria uma nova imagem com as dimensões desejadas
      $novaImagem = imagecreatetruecolor($novaLargura, $novaAltura);

      // Redimensiona a imagem para as novas dimensões
      imagecopyresampled($novaImagem, $imagem, 0, 0, 0, 0, $novaLargura, $novaAltura, $larguraAtual, $alturaAtual);

      // Salva a nova imagem em um arquivo
      imagejpeg($novaImagem, $caminhoDestino);

      // Libera a memória ocupada pelas imagens
      imagedestroy($imagem);
      imagedestroy($novaImagem);

      // Insira as informações no banco de dados
      include "conexao.php";

      $foto = $caminhoDestino;
      $comentario = $_POST["Lugar"];
      $dica = $_POST["dica"];

      // Prepara a consulta SQL
      $sql = "INSERT INTO tabela_destinos (foto, comentario, dica) VALUES (?, ?, ?)";
      $stmt = $conexao->prepare($sql);
     // Verifica se a preparação da consulta foi bem-sucedida
      if ($stmt) {
        // Vincula os parâmetros da consulta
        $stmt->bind_param("sss", $foto, $comentario, $dica);

        // Executa a consulta
        if ($stmt->execute()) {
          // Redireciona para a página de lugares após o envio bem-sucedido
          header("Location: lugares.php");
          exit;
        } else {
          // Se houver erro na execução da consulta, exibe mensagem de erro
          echo "Erro ao enviar o destino: " . $stmt->error;
        }

        // Fecha a consulta
        $stmt->close();
      } else {
        // Se houver erro na preparação da consulta, exibe mensagem de erro
        echo "Erro ao preparar a consulta: " . $conexao->error;
      }

      // Fecha a conexão com o banco de dados
      $conexao->close();

    } else {
      // Se o arquivo enviado não for uma imagem, redirecione de volta para o formulário
      header("Location: lugares.php");
      exit;
    }
  } else {
    // Se algum campo do formulário não foi preenchido, redirecione de volta para o formulário
    header("Location: lugares.php");
    exit;
  }
}
  
?>
