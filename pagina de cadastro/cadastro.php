<?php
include('../conecta/conexao.php');
session_start();
// require_once '../conecta/conexao.php';

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

        //PDO
        $stmt = $pdo->prepare($sql);

        //

        //organizando dados para sql
        $dados = [
            ':nome' => $_POST['nome'],
            ':senha' => $_POST['senha'],
            // senha criptografada
            // ':senha' => md5$_POST['senha'], 
            ':email' => $_POST['email'],
            ':telefone' => $_POST['telefone'],
            ':dataNascimento' => $_POST['dataNascimento']
        ];

        //executando INSERCAO COM SQL
        if($stmt->execute($dados)){
             header("location: ../index.html?msgSucesso= Cadastro Sucedido");
        }
    
    // caso de erro no processo de cadastro
    } catch (PDOException $e) {
        header("location: ../index.html?msgErro= Falha ao cadastrar...");
        die($e->getMessage());
    }
}
// se tiver dados vazios ou existentes
else {
     header("location: ../index.html?msgErro= Erro de Acesso");
}
//finaliza processo
die();
?>