<?php
/*
include('../../conexao/conn.php');

$sql =$pdo->query("SELECT *, count(ID) as achou FROM USUARIO WHERE LOGIN  ='".$_REQUEST['LOGIN']."'AND SENHA ='".md5($_REQUEST['SENHA'])."'"); 

while($resultado = $sql->fetch(PDO::FETCH_ASSOC)) {
    if($resultado['achou'] == 1) {
        session_start();
        $_SESSION['LOGIN'] = $resultado['LOGIN'];
        $_SESSION['TIPO'] = $resultado['TIPO_ID'];
        $dados = array(
            'tipo' => 'success',
            'mensagem' => 'Você entrou'
        );
        
    } else {
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'LOGIN e/ou SENHA incorretos'
        );
    }
}

echo json_encode($dados);