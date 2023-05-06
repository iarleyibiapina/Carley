<?php
session_start();
if(empty($_SESSION)){
    header("Location: ../index.html");
} else {
    session_destroy();
    header('Location: ../index.html');
}
die();