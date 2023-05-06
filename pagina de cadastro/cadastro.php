<?php
session_start();
// include('../php/conexao.php');
require_once '../conecta/conexao.php';

//se formulario vazio
if(empty($_POST['nome']) || empty($_POST['senha'])|| empty($_POST['telefone']) || empty($_POST['email']) || empty($_POST['dataNascimento'])){
    // $session[''] = true chamar div de aviso '
    $_SESSION['espaco_branco'] = true;
    header('Location: form.php');
    exit;
};

// quando tiver conteudo e resultado diferente
if(!empty($_POST)){
 //chega dados do POST para inserir no BD   
    //obtendo dados do POST
    try{
        //SQL
        $sql = "INSERT INTO usuario (nome,senha,email,telefone,data_nascimento) VALUES (:nome, :senha, :email, :telefone, :dataNascimento)";

    /*
        $sqlVerifica = "SELECT nome, senha, email, telefone, data_nascimento FROM usuario 
        WHERE email = :email AND senha = :senha";
        //
        $stmtVerifica = $pdo->prepare($sqlVerifica);
        $dados = array(
            //pega dados digitado para comparar no sql
            ':email' => $_POST['email'],
            // ':senha' => md5($_POST['senha']),
            ':senha' => $_POST['senha'],
        );
        $stmtVerifica->execute($dados);
        // executa sql
        $result = $stmtVerifica->fetchAll();
        // exibe as linhas do resultado
        if($stmtVerifica->rowCount() == 1){
            $_SESSION['usuario_existente'] == true;
            header("Location: ../painel_logado/index.html");
        } 
         VERIFICA USUARIO EXISTENTE
        $sqlVerifica = "SELECT COUNT(*) AS existente FROM usuario WHERE email = ':email'";
        $stmt->$pdo->prepare($sqlVerifica);

        if($stmt->execute($dados) == true){
            // para aparecer div de sucesso
            $_SESSION['cadastro_sucesso'] = true;
            header('Location: ../index.html');
            return;
        }
        */


        //PDO
        $stmt = $pdo->prepare($sql);

        //

        //organizando dados para sql
        $dados = array(
            ':nome' => $_POST['nome'],
            ':senha' => $_POST['senha'],
            // senha criptografada
            // ':senha' => md5$_POST['senha'], 
            ':email' => $_POST['email'],
            ':telefone' => $_POST['telefone'],
            ':dataNascimento' => $_POST['dataNascimento']
        );

        //executando INSERCAO COM SQL
        if($stmt->execute($dados)){
            header("Location: ../index.html");
            // header("location ../index.html?msgSucesso= Cadastro Sucedido");
        }
    
    // caso de erro no processo de cadastro
    } catch (PDOException $e) {
        die($e->getMessage());
        // header("location ../index.html?msgErro= Falha ao cadastrar...");
    }
}
// se tiver dados vazios ou existentes
else {
    header("Location: ../index.html");
    // header("location ../index.html?msgErro= Erro de Acesso");
}
//finaliza processo
die();
?>