<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (isset($_SESSION["nome"])) {
    $nomeUsuario = $_SESSION["nome"];
} else {
    $nomeUsuario = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lugares - Melhor Viagem</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      padding: 0;
      margin: 0;
    }

    .background-image {
      background-image: url("imagens/japao2.jpg");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }

    main {
      margin-bottom: 80px;
      /* Adicione uma margem inferior para dar espaço ao rodapé */
    }

    footer {
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      background-color: black;
      color: white;
      padding: 20px 0;
      text-align: center;
      font-size: 14px;
    }
  </style>
</head>

<body class="background-image">
  <header>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="lugares.php" id="lugares">Lugares</a></li>
        <li><a href="login.php" id="login">Login</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1 class="site-title">Lugares</h1>
    <!-- Conteúdo da página de Lugares -->
    <form action="processar_envio.php" method="POST" enctype="multipart/form-data">
      <label for="foto">Foto:</label>
      <input type="file" name="foto" id="foto">

      <label for="Lugar">Lugar:</label>
      <textarea name="Lugar" id="Lugar"></textarea>

      <label for="dica">Dica:</label>
      <input type="text" name="dica" id="dica">

      <button type="submit">Enviar</button>
    </form>


    <h2>Informações sobre lugares para viajar:</h2>
    <form action="" method="GET">
      <label for="busca">Buscar Comentários:</label>
      <input type="text" name="busca" id="busca" placeholder="Digite uma palavra">
      <button type="submit">Buscar</button>
    </form>
    <ul>
      <?php
      // Inclua o arquivo de conexão
      include "conexao.php";

      // Verifica se foi feita uma busca
      if (isset($_GET["busca"]) && !empty($_GET["busca"])) {
        $busca = $_GET["busca"];
        // Consulta para recuperar os dados da tabela_destinos filtrando pelo termo de busca
        $sql = "SELECT foto, comentario, dica FROM tabela_destinos WHERE comentario LIKE '%$busca%'";
      } else {
        // Consulta para recuperar todos os dados da tabela_destinos
        $sql = "SELECT foto, comentario, dica FROM tabela_destinos";
      }

      $result = $conexao->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $foto = $row["foto"];
          $comentario = $row["comentario"];
          $dica = $row["dica"];

          echo '<li>';
          echo '<h3>' . $comentario . '</h3>';
          echo '<img src="' . $foto . '" alt="Foto do Destino">';
          echo '<p>' . $dica . '</p>';
          echo '</li>';
        }
      } else {
        echo '<li>Nenhum destino cadastrado ainda.</li>';
      }
      ?>
    </ul>
  </main>

  <footer>
    <div class="footer-content">
      <p>Melhor Viagem</p>
      <p>Telefone: (xx) xxxx-xxxx</p>
      <p>Praça da Catedral, s/n - Zona 02, Maringá - PR, 87010-530</p>
    </div>
  </footer>

  <?php if (!empty($nomeUsuario)) { ?>
    <div class="usuario-logado">
      <p>Bem-vindo, <?php echo $nomeUsuario; ?>!</p>
    </div>
  <?php } ?>

</body>

</html>
