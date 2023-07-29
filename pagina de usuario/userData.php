<?php
require_once('../conecta/conexao.php');
session_start();

//PEGANDO OS DADOS DO USUARIO
echo $_SESSION['idusuario'];
echo $_SESSION['nome'];
echo $_SESSION['email']; 
echo $_SESSION['data_nascimento']; 
echo $_SESSION['telefone'];
