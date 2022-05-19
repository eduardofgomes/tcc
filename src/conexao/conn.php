<?php

    $hostname = "localhost";
    $database = "quadra";
    $username = "root";
    $password = "";

    if($conecta = mysqli_connect($hostname, $username, $password, $database)){
        echo 'Conectado ao banco de dados '.$database.'.....';
    } else {
        echo 'Erro: '.mysqli_connect_error();
    }