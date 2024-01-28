<?php
function tratar($dado){
    $dado = htmlspecialchars(trim(stripslashes($dado)));
    return $dado;
}

function validaEmail($email){
    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false;
    }
}

function validaNome($nome){
    $nome = ($_POST["name"]);
    if (!preg_match("/ ^[a-zA-Z-' ]* $/",$nome)) {
    return false;
    }
}