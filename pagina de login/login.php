<?php
session_start();
require_once '../conecta/conexao.php';
//auto completar do navegador, nao esta autenticando mesmo com dados iguais


//se formulario vazio
if(empty($_POST['email']) || empty($_POST['senha'])){
    // $session[''] = true chamar div de aviso '
    $_SESSION['espaco_branco'] = true;
    header('Location: form.php');
    exit;
};

//verifica se dados estao chegando pelo POST
if(!empty($_POST)){
    try {
        //SQL
        $sql = "SELECT * FROM usuario 
        WHERE email = :email AND senha = :senha";
        //para selecionar apenas email e senha

        //PDO
        $stmt = $pdo->prepare($sql);

        //DADOS para SQL
        $dados = array(
            ':email' => $_POST['email'],
            // ':senha' => md5($_POST['senha']),
            ':senha' => ($_POST['senha']),
        );

        $stmt->execute($dados);
         //$stmt->execute(array(':email' => $_POST['email'], ':senha' => $_POST['senha']));

        $result = $stmt->fetchAll();
        // retorna numero de linhas

        // se numero de linhas coincidir com banco
        if($stmt->rowCount() == 1){
            //autenticaçao concluida
            //definindo sessions
            $result = $result[0];
            $_SESSION['idusuario'] = $result['id_usuario'];
            $_SESSION['nome'] = $result['nome'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['data_nascimento'] = $result['data_nascimento'];
            $_SESSION['telefone'] = $result['telefone'];

            header("Location: ../painel_logado/painel.php");
        } else {
            //autenticação falhada
            session_destroy();
            header("Location: form.php?msgErroAutenticacao=Não foi possível autenticar");
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
} else {
    // se processo login der erro antes de verificar
    header("location: ../form.php?msgErroVerificacao=Não foi possível Verificar");
}
die();
?>