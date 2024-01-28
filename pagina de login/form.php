<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../images/logo.png" />
    <title>Login</title>
    <link rel="stylesheet" href="../style/form.css" />
    <link rel="stylesheet" href="../style/warning.css" />
  </head>
  <body>
    <div class="all">
      <!-- incorreto -->
      <?php
      if(isset($_SESSION['login_incorreto'])): 
      ?>
      <div class="error"><p>Nome ou senha incorreto!</p></div>
      <?php 
      endif; 
      unset($_SESSION['login_incorreto']);
      ?>

<div class="container">
        <?php if(!empty($_GET['msgErroVerificacao'])) {?>
          <?php echo $_GET['msgErroVerificacao']; ?>
          <?php } ?>
          <form class="box" action="login.php" method="post">
            <h1>Login</h1>
            <!-- espaço_branco -->
        <?php if(isset($_SESSION['espaco_branco'])) {?>
        <?php echo "<span class='error'> Há espaço em branco! <br></span>" ?>
        <?php } unset($_SESSION['espaco_branco']);?>
            <!-- incorreto -->
        <?php if(!empty($_GET['msgErroAutenticacao'])) {?>
        <?php echo "<span class='error'> Nome ou senha incorreto! <br></span>" ?>
        <?php } ?>
        <input type="text" placeholder="Email" name="email" />
        <input type="password" placeholder="Password" name="senha" />
        <div class="btn">
          <input type="submit" name="login" value="Login" />
          <div class="btn_invisivel">
            <a href="../index.html">
              <span>Voltar</span>
            </a>
          </div>
        </div>
      </form>
    </div>
    </div>
  </body>
</html>
