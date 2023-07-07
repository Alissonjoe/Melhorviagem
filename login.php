<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Melhor Viagem - Login</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background-image: url("imagens/canada.jpg");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }
  </style>
</head>

<body>
  <div class="banner">
    <img src="imagens/mar.jpg" alt="Imagem do mar">
    <img src="imagens/natureza.jpg" alt="Imagem da natureza">
  </div>

  <header>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="lugares.php" id="lugares">Lugares</a></li>
        <?php if (isset($_SESSION["username"])) { ?>
        <li><a href="logout.php">Sair</a></li>
        <?php } else { ?>
        <li><a href="login.php" id="login">Login</a></li>
        <?php } ?>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Login</h1>
    <?php
    session_start();
    if (isset($_SESSION["username"])) {
      echo "<p>Bem-vindo, " . $_SESSION["username"] . "</p>";
    }
    ?>
    <form action="processar_login.php" method="POST">
      <input type="text" name="email" placeholder="E-mail" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Entrar</button>
    </form>

    <h2>Criar Novo Cadastro</h2>
    <form action="processar_cadastro.php" method="POST">
      <input type="text" name="nome" placeholder="Nome" required>
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Criar Cadastro</button>
    </form>
  </main>

  <footer>
    <div class="footer-content">
      <p>Melhor Viagem</p>
      <p>Telefone: (xx) xxxx-xxxx</p>
      <p>Praça da Catedral, s/n - Zona 02, Maringá - PR, 87010-530</p>
    </div>
  </footer>
</body>

</html>
