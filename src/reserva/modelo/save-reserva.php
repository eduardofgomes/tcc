<?php

    // Obter a nossa conexão com o banco de dados
    include('../../conexao/conn.php');

    
    // Obter os dados enviados do formulário via $_REQUEST
    $requestData = $_REQUEST;

    
    //$sql =$pdo->query("SELECT *, count(ID) as achou FROM CIDADAO WHERE ID");
    session_start();
    $CIDADAO = $_SESSION['ID'];
    $DIA = $requestData['DIA'];
    $HORARIO = $requestData['HORARIO'];
    $QUADRA = $requestData['QUADRAS'];
    
    

    // Verificação de campo obrigatórios do formulário
    if(empty($requestData['DIA'])){
        // Caso a variável venha vazia eu gero um retorno de erro do mesmo
        $dados = array(
            "tipo" => 'error',
            "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s).'
        );
    } else {
        // Caso não exista campo em vazio, vamos gerar a requisição
        $ID = isset($requestData['ID']) ? $requestData['ID'] : '';
        $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

        // Verifica se é para cadastrar um novo registro
        if($operacao == 'insert'){
            // Prepara o comando INSERT para ser executado
            $sql = "SELECT COUNT(ID) AS ACHOU FROM RESERVAS WHERE QUADRAS_ID = $QUADRA AND DIA_ID = $DIA AND HORARIO_ID = $HORARIO";
            $sql = $pdo->query($sql);
            $resultado = $sql->fetch(PDO::FETCH_ASSOC);
            if($resultado['ACHOU'] > 0) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Este horário já foi reservado.'
                );
            } else {
                try{               

                
                    $stmt = $pdo->prepare('INSERT INTO RESERVAS (DIA_ID, HORARIO_ID, QUADRAS_ID, CIDADAO_ID) VALUES (:a, :b, :c, :d)');
                    $stmt->execute(array(
                        ':a' => $requestData['DIA'],
                        ':b' => $requestData['HORARIO'],
                        ':c' => $requestData['QUADRAS'],
                        ':d' => $CIDADAO
                    ));
                    $dados = array(
                        "tipo" => 'success',
                        "mensagem" => 'Registro salvo com sucesso.'
                    );
                } catch(PDOException $e) {
                    $dados = array(
                        "tipo" => 'error',
                        "mensagem" => 'Não foi possível efetuar a reserva.'
                    );
                }
            }
            
        } else {
        
        }
    }

    // Converter um array de dados para a representação JSON
    echo json_encode($dados);