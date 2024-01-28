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
    <title>Cadastro</title>
    <link rel="stylesheet" href="../style/form.css" />
    <link rel="stylesheet" href="../style/warning.css">
  </head>
  <body>
    <div class="all">
      <!-- FORMULARIO -->
      <form class="box" action="cadastro.php" method="post">
        <h1>Cadastro</h1>
        <!-- espaço_branco -->
        <?php if(isset($_SESSION['espaco_branco'])) {?>
        <?php echo "<span class='error'>  Há espaço em branco! <br></span>" ?>
        <?php } unset($_SESSION['espaco_branco']);?>
            <!-- incorreto -->
        <?php if(!empty($_GET['msg_Erro'])) {?>
        <?php echo "<span class='error'> Nome de usuario existente! <br></span>" ?>
        <?php } ?>
        <!-- nome -->
        <input required type="text" name="nome" placeholder="Nome" />
        <!-- senha -->
        <input required type="password" name="senha" placeholder="Nova senha" />
        <!-- telefone -->
        <input required type="text" class="telefone" name="telefone" placeholder="Telefone" />
        <!-- data nascimento -->
        <input required type="date" class="data" name="dataNascimento" placeholder="Data Nascimento" />
        <!-- email -->
        <input required type="text" class="email" name="email" placeholder="Email" />
        <div class="btn">
          <input type="submit" name="cadastro" value="Cadastro" />
          <div class="btn_invisivel">
            <a href="../index.html">
              <span>Voltar</span>
            </a>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
