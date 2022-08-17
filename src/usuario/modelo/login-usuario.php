<?php

include('../../conexao/conn.php');

$sql =$pdo->query("SELECT *, count(ID) as achou FROM  usuario WHERE login  ='".$_REQUEST['login']."'AND senha ='".md5($_REQUEST['senha'])."'"); 

while($resultado = $sql->fetch(PDO::FETCH_ASSOC)) {
    if($resultado['achou'] == 1) {
        session_start();
        $_SESSION['nome'] = $resultado['nome'];
        $_SESSION['tipo'] = $resultado['tipo_id'];
        $dados = array(
            'tipo' => 'success',
            'mensagem' => 'Você entrou'
        );
        
    } else {
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'Login e/ou senha incorretos'
        );
    }
}

echo json_encode($dados);