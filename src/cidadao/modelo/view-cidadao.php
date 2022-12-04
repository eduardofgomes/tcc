<?php

    include('../../conexao/conn.php');

    $ID = $_REQUEST['ID'];
    $USUARIO_ID = $_REQUEST['USUARIO_ID'];

    $sql = "SELECT * FROM CIDADAO WHERE ID = $ID";
    $sql2 = "SELECT * FROM USUARIO WHERE ID = $USUARIO_ID";

    $resultado = $pdo->query($sql);
    $resultado2 = $pdo->query($sql2);

    if($resultado){
        $result = array();
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)){

            $result = array_map('utf8_encode', $row);
        }
        $dados = array(
            'tipo' => 'success',
            'mensagem' => '',
            'dados' => $result
        );
    } else {
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'Não foi possível obter o registro solicitado.',
            'dados' => array()
        );
    }

    if($resultado2){
        $result = array();
        while($row2 = $resultado2->fetch(PDO::FETCH_ASSOC)){

            $result2 = array_map('utf8_encode', $row2);
        }
        $dados2 = array(
            'tipo' => 'success',
            'mensagem' => '',
            'dados' => $result2
        );
    } else {
        $dados2 = array(
            'tipo' => 'error',
            'mensagem' => 'Não foi possível obter o registro solicitado.',
            'dados' => array()
        );
    }

    echo json_encode($dados);
    echo json_encode($dados2);