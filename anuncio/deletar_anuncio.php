<?php
session_start();
require_once('../conecta/conexao.php');
if(empty($_SESSION)){
    die(header("location: ../index.html?ErroDEL"));
}

$result = array();

if(!empty($_GET['id_anuncio'])){

    try{
        $sql = "SELECT * FROM anuncio_pdo WHERE id_usuario = :id_usuario AND id_anuncio = :id_anuncio";

        $stmt = $pdo->prepare($sql);

        $stmt->execute(array(':id_anuncio' => $_GET['id_anuncio'], ':id_usuario' => $_SESSION['idusuario']));

        if($stmt->rowCount() == 1){
            //registro obtido no banco
            $result = $stmt->fetchAll();
            $result = $result[0]; //informaçoes a serem alteradas do registro
        } else {
            die(header('Location: ../painel_logado/painel.php?DEL_ERRO'));
        } 
    } catch (PDOException $e) {
        die($e->getMessage());
    }
} else {
    die(header("location: ../painel_logado/painel.php?ERRO_empty"));
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
</head>
<body>
    <header>
        <div class="nome">
            <h1>Excluir Anuncio:</h1>
        </div>
        <nav>
            <ul><a href="../anuncio/cadastrar_anuncio.php">Inserir anuncio</a></ul>
            <ul><a href="../painel_logado/painel.php?meus_anuncios=1">Meus anuncios</a></ul>
            <ul><a href="../painel_logado/painel.php?meus_anuncios=0">Ver todos anuncios</a></ul>
            <ul><a class="logout" href="logout.php">Sair</a></ul>
        </nav>
    </header>
    <div class="container">
        <div class="form-container">
            <form action="processa_anuncio.php?id_anuncio=<?php echo $result['id_anuncio']; ?>" method="post">
                <div class="inputs">
                <input type="text" autofocus placeholder="Titulo" name="titulo" value="<?php echo $result['titulo']?>" readonly>
                <textarea style="resize:none;" value="" placeholder="Descrição" maxlength="255" name="descricao" rows="5" cols="30" readonly><?php echo $result['descricao'] ?></textarea>

                <input type="file" name="foto" readonly>
                </div>
                <div class="btn" style="justify-content:center";>
                    <style>
                        .form-container a:hover {
                        transform: scale(1.05);
                        color: var(--orange);
                        border-color: var(--orange);  
                        }   
                        .btn button:hover {
                        transform: scale(1.05);
                        color: red;
                        border-color: red;
                        }
                    </style>
                    <a href="../painel_logado/painel.php">Cancelar</a>
                <button name="enviarDados" value="DEL" type="submit">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>