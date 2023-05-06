<?php
    $host = "localhost";
    $port = "5432";
    $user = "postgres";
    $password = "123";
    $dbname = "BDcatalogo";

    //usando PDO
    try {
        $pdo = new PDO("pgsql:host=$host; port=$port; dbname=$dbname", $user,$password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    } catch (PDOException $e) {

        die($e->getMessage());
    }
?>