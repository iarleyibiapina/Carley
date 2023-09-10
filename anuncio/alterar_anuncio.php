<?php
require_once '../conecta/conexao.php';
session_start();
if(empty($_SESSION)){
    header("location: ../index.html");
    die();
}

$result = array();

if(!empty($_GET['id_anuncio'])){
    try{
    $sql = "SELECT * FROM anuncio_pdo WHERE id_usuario = :id_usuario AND id_anuncio = :id_anuncio";
        $stmt = $pdo->prepare($sql);

        $dados = array(
        ':id_usuario' => $_SESSION['idusuario'],
        ':id_anuncio' => $_GET['id_anuncio']);

        $stmt->execute($dados);
        if($stmt->rowCount() == 1){
            $result = $stmt->fetchAll();
            $result = $result[0];
        } else {
            header("Location: ../painel_logado/painel.php?Erro=SQL ERROR");
        }
    } catch (PDOException $e) {
        header("Location: ../painel_logado/painel.php?Erro=PDOEXception");
    }
} else {
    header("Location: ../painel_logado/painel.php?Erro=GETUSUARIO");    
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
            <h1>Editar Anuncio:</h1>
        </div>
        <nav>
            <ul class="nav-list">
                <li>
                    <a href="../anuncio/cadastrar_anuncio.php">Inserir anuncio</a>
                </li>
                <li>
                    <a href="../painel_logado/painel.php?meus_anuncios=1">Meus anuncios </a>
                </li>
                <li><a href="../painel_logado/painel.php?meus_anuncios=0">Ver todos anuncios</a>
                </li>
                <li>
                    <a class="logout" href="logout.php">Sair</a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="form-container">
            <form action="processa_anuncio.php?id_anuncio=<?php echo $result['id_anuncio'];?>" method="post">
                <div class="inputs">
                <input type="text" value="<?php echo $result['titulo'] ?>" autofocus placeholder="Titulo" name="titulo" maxlength="50">
                <textarea style="resize:none;" value="" placeholder="Descrição" maxlength="255" name="descricao" rows="5" cols="30"><?php echo $result['descricao'] ?></textarea>
                <input type="file" name="foto">
                </div>
                <div class="btn">    
                    <a href="../painel_logado/painel.php">Cancelar</a>
                <input type="reset" value="Resetar">
                <button name="enviarDados" value="ALT" type="submit">Inserir</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>