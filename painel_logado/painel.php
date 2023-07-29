<?php
require_once('../conecta/conexao.php');
session_start();

//se sessao ainda nao definidas(pelo processo de login) entao o acesso nao esta autorizado
if(empty($_SESSION)){
    header("location: ../index.php");
    die();
}

// EXIBINDO ANUNCIOS
// OU APENAS DO USUARIO OU TUDO
$anuncios = array();

// APENAS DO USUARIO
if(!empty($_GET['meus_anuncios']) && $_GET['meus_anuncios'] == 1){
    try{
    $sql = "SELECT * FROM anuncio_pdo WHERE id_usuario = :idusuario ORDER BY id_anuncio ASC";
    $dados = array(':idusuario' => $_SESSION['idusuario']);
            $stmt = $pdo->prepare($sql);
            if($stmt->execute($dados)){
                $anuncios = $stmt->fetchAll();
            } else {
                die("falha ao buscar anuncio do usuario");
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
} else {
    // BUSCAR TODOS ANUNCIOS
    try{
        $sql = "SELECT * FROM anuncio_pdo ORDER BY id_anuncio ASC";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute()){
            // anuncios vai receber a quantidade de linhas da tabela
            $anuncios = $stmt->fetchAll();
        } else {
            die("Falha ao buscar anuncio");
        }
    } catch (PDOException $e){
        die($e->getMessage());
    } 
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
</head>
<body>
    <header>
        <div class="nome">
            <h1>Bem vindo, <?php echo $_SESSION['nome']?>!</h1>
        </div>
        <nav>
            <a href="../pagina de usuario/userProfile.php" title="Abrir para perfil"><ion-icon class="user-icon" name="person-circle-outline"></ion-icon></a>
            <ul><a href="../anuncio/cadastrar_anuncio.php">Inserir anuncio</a></ul>
            <!-- se 1, atualiza a pagina verifica IF em cima e retorna sql com dados apenas do usuario -->
            <ul><a href="./painel.php?meus_anuncios=1">Meus anuncios</a></ul>
            <!-- se 0, atualiza pagina passa no IF, e exibe todos -->
            <ul><a href="./painel.php?meus_anuncios=0">Ver todos anuncios</a></ul>
            <ul><a class="logout" href="logout.php">Sair</a></ul>
        </nav>
    </header>
    <main>
    <?php
      if(isset($_SESSION['anuncio_concluido'])): 
      ?>
            <div class=""><p><?php echo$_GET['anuncio_concluido'] ?></p></div>
      <?php 
      endif; 
      unset($_SESSION['anuncio_concluido']);
      ?>
    <?php
      if(isset($_SESSION['anuncio_erro'])): 
      ?>
      <div class=""><p><?php echo$_GET['anuncio_erro'] ?> </p></div>
      <?php 
      endif; 
      unset($_SESSION['anuncio_erro']);
      ?>

      <!-- imprimindo anuncios -->
      <?php if(!empty($anuncios)) { ?>
        <?php foreach($anuncios as $a) {?>
            <!-- COMEÇO ANUNCIO -->
        <div class="content">
            <div class="header-card">
                <!-- colocar <a> e abrir modal -->
                <div title="Postado por: <?php echo $a["nomeusuariopostado"]?>"><ion-icon class="user-icon" name="person-outline"></ion-icon></div>
            <h2 class="tituloProduto"><?php echo $a['titulo'] ?></h2>
            <!-- CASO ANUNCIO DO USUARIO -->
            <?php if($a['id_usuario'] == $_SESSION['idusuario']): ?>
                <a href="../anuncio/alterar_anuncio.php?id_anuncio=<?php echo $a['id_anuncio']; ?>" class="btnEditar">Editar</a>
                <a href="../anuncio/deletar_anuncio.php?id_anuncio=<?php echo $a['id_anuncio']; ?>" class="btnExcluir">Excluir</a>
            <?php endif ?>
            </div>
            <img style="width: 300px; height: 200px;"src="../images/car-card.png" alt="imgProdutoAqui">
            <p ><strong>Descrição</strong></p>
            <p class="descricao"><?php echo $a['descricao'] ?></p>
        </div>
        <!-- FIM ANUNCIO -->
            <?php }?>
        <?php } ?>

    </main>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
</body>
</html>

