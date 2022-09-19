<?php

    include('../../conexao/conn.php');

    $sql = "SELECT * FROM TIPO ORDER BY NOME DESC";    

    $resultado = $pdo->query($sql);
    
    $dados = array();
    if($resultado){
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = array_map("utf8_decode", $row);
        }
    }
    //echo var_dump($dados) . "</br>";
    echo json_encode($dados);