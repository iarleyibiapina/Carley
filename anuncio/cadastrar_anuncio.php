<?php
session_start();
if(empty($_SESSION)){
    header("location: ../index.html");
    die();
}
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
    <link rel="stylesheet" href="../style/anuncio.css">
    <link rel="stylesheet" href="../style/media.css">
    
</head>
<body>
    <header>
        <div class="nome">
            <h1>Inserindo Anuncio:</h1>
        </div>
        <nav>
            <ul class="nav-list">
            <li><a href="../anuncio/cadastrar_anuncio.php">Inserir anuncio</a></li>
            <li><a href="../painel_logado/painel.php?meus_anuncios=1">Meus anuncios</a></li>
            <li><a href="../painel_logado/painel.php?meus_anuncios=0">Ver todos anuncios</a></li>
            <li><a class="logout" href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="form-container">
            <form action="./processa_anuncio.php" method="post">
                <div class="inputs">
                    <!-- titulo -->
                <input type="text" autofocus placeholder="Titulo" name="titulo" maxlength="50">
                <!-- descricao -->
                <textarea style="resize:none;" placeholder="Descrição" maxlength="255" name="descricao" rows="5" cols="30"></textarea>
                <!-- arquivo de foto / inutil -->
                <input type="file" name="foto">
                </div>
                <!-- botoes -->
                <div class="btn">    
                    <a href="../painel_logado/painel.php">Cancelar</a>
                <input type="reset" value="Resetar">
                <button name="enviarDados" value="CAD" type="submit">Inserir</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>