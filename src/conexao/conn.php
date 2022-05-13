<?php

    $hostname = "sql102.epizy.com";
    $database = "epiz_31454917_rifa";
    $username = "epiz_31454917";
    $password = "tyvw9mgQspJ3";

    if($conecta = mysqli_connect($hostname, $username, $password, $database)){
        echo 'Conectado ao banco de dados '.$database.'.....';
    } else {
        echo 'Erro: '.mysqli_connect_error();
    }