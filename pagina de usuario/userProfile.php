<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel <?php echo $_SESSION['nome']?></title>
    <link rel="icon" href="../images/logo.png" />
    <link rel="stylesheet" href="../style/painel_logado.css">
</head>
<body>
    <h1><?php echo $_SESSION['nome']?></h1>
    <h2><?php echo $_SESSION['email']?></h2>
    <h3><?php echo $_SESSION['data_nascimento']?></h3>
    <h4><?php echo $_SESSION['telefone']?></h4>
</body>
</html>