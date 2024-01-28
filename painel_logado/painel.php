<?php
require_once('../conecta/conexao.php');
session_start();

//se sessao ainda nao definidas(pelo processo de login) entao o acesso nao esta autorizado
if (empty($_SESSION)) {
    header("location: ../index.php");
    die();
}

// EXIBINDO ANUNCIOS
// OU APENAS DO USUARIO OU TUDO
$anuncios = array();

// APENAS DO USUARIO
if (!empty($_GET['meus_anuncios']) && $_GET['meus_anuncios'] == 1) {
    try {
        $sql = "SELECT * FROM anuncio_pdo WHERE id_usuario = :idusuario ORDER BY id_anuncio ASC";
        $dados = array(':idusuario' => $_SESSION['idusuario']);
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute($dados)) {
            $anuncios = $stmt->fetchAll();
        } else {
            die("falha ao buscar anuncio do usuario");
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
} else {
    // BUSCAR TODOS ANUNCIOS
    try {
        $sql = "SELECT * FROM anuncio_pdo ORDER BY id_anuncio ASC";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            // anuncios vai receber a quantidade de linhas da tabela
            $anuncios = $stmt->fetchAll();
        } else {
            die("Falha ao buscar anuncio");
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

// trazendo quantidade anuncios de usuario conectado
try {
    // buscar quantidade de anuncios
    $sql = "SELECT id_anuncio, id_usuario FROM anuncio_pdo WHERE id_usuario = :idusuario ORDER BY id_anuncio ASC";
    $dados = array(':idusuario' => $_SESSION['idusuario']);
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($dados)) {
        $quantidadeAnuncios = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } else {
        die("falha ao buscar anuncio do usuario");
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel <?php echo $_SESSION['nome'] ?></title>
    <link rel="icon" href="../images/logo.png" />
    <link rel="stylesheet" href="../style/painel_logado.css">
    <link rel="stylesheet" href="../style/modal.css">
    <link rel="stylesheet" href="../style/media.css">
</head>

<body>
    <header>
        <div class="nome">
            <h1>Bem vindo, <?php echo $_SESSION['nome'] ?>!</h1>
            <div class="hover-icon" onclick=see_profile() title="Abrir perfil"><ion-icon class="user-icon" name="person-circle-outline"></ion-icon>Visualizar Perfil</div>
        </div>
        <!-- NAVBAR -->
        <nav>
            <div class="btn-navbar" id="btn-abrir-navbar">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
            <ul class="nav-list">
                <li><a href="../anuncio/cadastrar_anuncio.php">Inserir anuncio</a></li>
                <!-- se 1, atualiza a pagina verifica IF em cima e retorna sql com dados apenas do usuario -->
                <li><a href="./painel.php?meus_anuncios=1">Meus anuncios</a></li>
                <!-- se 0, atualiza pagina passa no IF, e exibe todos -->
                <li><a href="./painel.php?meus_anuncios=0">Ver todos anuncios</a></li>
                <li><a class="logout" href="logout.php">Sair</a></li>
            </ul>
        </nav>
        <!-- FIMNAVBAR -->
    </header>
    <main>
        <div id="open_modal" class="modal ">
            <div class="modal-content">
                <div class="name_profile">
                    <h1><?php echo $_SESSION['nome'] ?></h1>
                    <hr>
                </div>
                <div class="email">
                    <strong>
                        <p>Email:</p>
                    </strong>
                    <sub><?php echo $_SESSION['email'] ?></sub>
                    <hr>
                </div>
                <div class="phone_profile">
                    <strong>
                        <p>Telefone:</p>
                    </strong>
                    <sub><?php echo $_SESSION['telefone'] ?></sub>
                    <hr>
                </div>
                <div class="announcement_posted">
                    <strong>
                        <p>Anuncios Postados: <?php echo count($quantidadeAnuncios) ?><a href="./painel.php?meus_anuncios=1">Exibir</a></p>
                    </strong>
                    <hr>
                </div>
            </div>
        </div>
        <section class="announcement" id="announcement_modal">
            <?php if (isset($_SESSION['anuncio_concluido'])) : ?>
                <div class="">
                    <p><?php echo $_GET['anuncio_concluido'] ?></p>
                </div>
            <?php endif;
            unset($_SESSION['anuncio_concluido']); ?>
            <?php if (isset($_SESSION['anuncio_erro'])) : ?>
                <div class="">
                    <p><?php echo $_GET['anuncio_erro'] ?> </p>
                </div>
            <?php endif;
            unset($_SESSION['anuncio_erro']); ?>

            <!-- imprimindo anuncios -->
            <?php if (!empty($anuncios)) { ?>
                <?php foreach ($anuncios as $a) { ?>
                    <!-- COMEÇO ANUNCIO -->
                    <div class="content">
                        <div class="header-card">
                            <div title="Postado por: <?php echo $a["nomeusuariopostado"] ?>"><ion-icon class="user-icon" name="person-outline"></ion-icon></div>
                            <h2 class="tituloProduto"><?php echo $a['titulo'] ?></h2>
                            <!-- CASO ANUNCIO DO USUARIO -->
                            <?php if ($a['id_usuario'] == $_SESSION['idusuario']) : ?>
                                <a href="../anuncio/alterar_anuncio.php?id_anuncio=<?php echo $a['id_anuncio']; ?>" class="btnEditar">Editar</a>
                                <a href="../anuncio/deletar_anuncio.php?id_anuncio=<?php echo $a['id_anuncio']; ?>" class="btnExcluir">Excluir</a>
                            <?php endif ?>
                        </div>
                        <!-- <img style="width: 300px; height: 200px;" src="../images/car-card.png" alt="imgProdutoAqui"> -->
                        <img style="width: 300px; height: 200px;" src="..<?php echo empty($a['path_img']) ?  "/public/img/placeholder.png" : $a['path_img']; ?>
" alt="imgProdutoAqui">
                        <p><strong>Descrição</strong></p>
                        <p class="descricao"><?php echo $a['descricao'] ?></p>
                    </div>
                    <!-- FIM ANUNCIO -->
                <?php } ?>
            <?php } ?>
        </section>
    </main>

    <script src="../script/modal.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="../script/navBar.js"></script>
</body>

</html>