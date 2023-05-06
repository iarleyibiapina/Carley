<?php
require_once('../conecta/conexao.php');
session_start();
if(empty($_SESSION)){
    header("Location: ../index.html");
    die();
}
// --------------------------------
if(!empty($_POST)){
//chegando dados do formulario pelo POST, verifica se é CADastro / ALTerar / DELetar

//se submit do formulario for igual ao codigo CAD
//CADASTRO
if($_POST['enviarDados'] == 'CAD'){
    try{
    //SQL
    $sql = "INSERT INTO anuncio_pdo (id_usuario, titulo, descricao) VALUES (:id_usuario,:titulo,:descricao)";
    //PDO
    $stmt = $pdo->prepare($sql);
    //DADOS
    $dados = array(
        // id usuario da tabela usuario vai para tabela anuncio 
        // conteudo da SESSION é passada
        ':id_usuario' => $_SESSION['idusuario'],
        ':titulo' => $_POST['titulo'],
        ':descricao' => $_POST['descricao']
    );
    //INSERT
    if($stmt->execute($dados)){
        header("Location:../painel_logado/painel.php?anuncio_concluido=Anuncio Cadastrado");
    }
} catch (PDOException $e) {
    header("Location:../painel_logado/painel.php?anuncio_erro=Erro");
    die($e->getMessage());
    }
}
// ALTERAR
elseif ($_POST['enviarDados'] == 'ALT'){
    try{
        //SQL
        $sql = "UPDATE anuncio_pdo SET 
            titulo = :titulo,
            descricao = :descricao
            WHERE
            id_anuncio = :id_anuncio AND
            id_usuario = :id_usuario";
        //DADOS
        $dados = array(
            ':id_anuncio' => $_POST['id_anuncio'],
            ':id_usuario' => $_SESSION['idusuario'],
            ':titulo' => $_POST['titulo'],
            ':descricao' => $_POST['descricao']
        );
        //PDO
        $stmt = $pdo->prepare($sql);
        //EXECUTANDO SQL
        if($stmt->execute($dados)){
            header("Location: ../painel_logado/painel.php?anuncio_concluido=Alteraçao Feita");
        } else {
            header("Location: ../painel_logado/painel.php?anuncio_erro=Alteraçao falhada");
        }
    } catch (PDOException $e) {
        header("Location:../painel_logado/painel.php?anuncio_erro=Erro");
        die($e->getMessage());
    }
}
//EXCLUIR
elseif($_POST['enviarDados'] == 'DEL') {
    try{
        $sql = "DELETE FROM anuncio_pdo WHERE id_anuncio = :id_anuncio AND id_usuario = :idusuario";

        $stmt = $pdo->prepare($sql);

        $dados = array(
        ':id_anuncio' => $_POST['id_anuncio'],
        ':idusuario' => $_SESSION['idusuario']
        );

        if($stmt->execute($dados)){
            header("Location: ../painel_logado/painel.php?anuncio_erro=Deletado");
        } else {
            header("Location: ../painel_logado/painel.php?ANUNCIO_NAO_Deletado");            
        }

    } catch (PDOException $e) {
        header("Location:../painel_logado/painel.php?ERRO_SQL");
        die($e->getMessage());
    }
}

}
?>