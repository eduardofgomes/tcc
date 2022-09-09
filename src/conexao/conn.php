<?php
    
    $hostname = "localhost";
    $dbname = "quadra";
    $username = "root";
    $password = "";

    try{
        $pdo = new PDO('mysql:host='.$hostname.';dbname='.$dbname, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conexão com o banco de dados realizada com sucesso";
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }

