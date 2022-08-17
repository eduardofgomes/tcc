<?php

    // Obter a nossa conexão com o banco de dados
    include('../../conexao/conn.php');

    // Obter os dados enviados do formulário via $_REQUEST
    $requestData = $_REQUEST;

    // Verificação de campo obrigatórios do formulário
    if(empty($requestData['nome'])){
        // Caso a variável venha vazia eu gero um retorno de erro do mesmo
        $dados = array(
            "tipo" => 'error',
            "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s).'
        );
    } else {
        // Caso não exista campo em vazio, vamos gerar a requisição
        $ID = isset($requestData['id']) ? $requestData['id'] : '';
        $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

        // Verifica se é para cadastrar um novo registro
        if($operacao == 'insert'){
            // Prepara o comando INSERT para ser executado
            try{
                $stmt = $pdo->prepare('INSERT INTO usuario (nome, email, login, senha, tipo_id) VALUES (:a, :b, :c, :d, :e)');
                $stmt->execute(array(
                    ':a' => $requestData['nome'],
                    ':b' => $requestData['email'],
                    ':c' => $requestData['login'],
                    ':d' => md5($requestData['senha']),
                    ':e' => $requestData['tipo_id']
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Registro salvo com sucesso.'
                );
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível efetuar o cadastro do curso.'
                );
            }
        } else {
            // Se minha variável operação estiver vazia então devo gerar os scripts de update
            try{
                $stmt = $pdo->prepare('UPDATE usuario SET nome = :a, email = :b, login = :c, senha = :d, tipo_id = :e WHERE id = :id');
                $stmt->execute(array(
                    ':id' => $ID,
                    ':a' => $requestData['nome'],
                    ':b' => $requestData['email'],
                    ':c' => $requestData['login'],
                    ':d' => md5($requestData['senha']),
                    ':e' => $requestData['tipo_id']
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Registro atualizado com sucesso.'
                );
            } catch (PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível efetuar o alteração do registro.'
                );
            }
        }
    }

    // Converter um array de dados para a representação JSON
    echo json_encode($dados);
