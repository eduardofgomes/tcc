<?php

    // Obter a nossa conexão com o banco de dados
    include('../../conexao/conn.php');

    // Obter os dados enviados do formulário via $_REQUEST
    $requestData = $_REQUEST;

    // Verificação de campo obrigatórios do formulário
    if(empty($requestData['EMAIL'])){
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
            try{
                $stmt = $pdo->prepare('INSERT INTO USUARIO (EMAIL, LOGIN, SENHA, TIPO_ID) VALUES (:a, :b, :c, :d)');
                $stmt->execute(array(
                    ':a' => $requestData['EMAIL'],
                    ':b' => $requestData['LOGIN'],
                    ':c' => md5($requestData['SENHA']),
                    ':d' => $requestData['TIPO_ID']
                )); 
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Registro salvo com sucesso.'
                );
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível efetuar o cadastro do usuario.'
                );
            }
        } else {
            // Se minha variável operação estiver vazia então devo gerar os scripts de update
            try{
                $stmt = $pdo->prepare('UPDATE USUARIO SET EMAIL = :a, LOGIN = :b, SENHA = :c, TIPO_ID = :d WHERE id = :id');
                $stmt->execute(array(
                    ':id' => $ID,
                    ':a' => $requestData['EMAIL'],
                    ':b' => $requestData['LOGIN'],
                    ':c' => md5($requestData['SENHA']),
                    ':d' => $requestData['TIPO_ID']
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Registro atualizado com sucesso.'
                );
            } catch (PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível efetuar a alteração do registro.'
                );
            }
        }
    }

    // Converter um array de dados para a representação JSON
    echo json_encode($dados);
