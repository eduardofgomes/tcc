<?php

include('../../conexao/conn.php');

$sql =$pdo->query("SELECT *, count(ID) as achou FROM USUARIO WHERE EMAIL  ='".$_REQUEST['EMAIL']."'AND SENHA ='".md5($_REQUEST['SENHA'])."'"); 

while($resultado = $sql->fetch(PDO::FETCH_ASSOC)) {
    if($resultado['achou'] == 1) {
        session_start();
        $_SESSION['EMAIL'] = $resultado['EMAIL'];
        $_SESSION['USUARIO_ID'] = $resultado['USUARIO_ID'];
        $dados = array(
            'tipo' => 'success',
            'mensagem' => 'Você entrou'
        );
        
    } else {
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'EMAIL e/ou SENHA incorretos'
        );
    }
}

echo json_encode($dados);