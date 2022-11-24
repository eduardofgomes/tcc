    <?php

    session_start();

    if(!isset($_SESSION['EMAIL'])  && !isset($_SESSION['ID'])) {
        $dados = array(
            'tipo' => 'error',
            'mensagem' => 'Você não está cadastrado'
        );
    } else {
        $dados = array(
            'tipo' => 'success',
            'mensagem' => 'Seja bem vindo '.$_SESSION['EMAIL']
        );
    }

    echo json_encode($dados);
    