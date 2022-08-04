<?php

    include('../../conexao/conn.php');

    $requestData = $_REQUEST;
    
    if(empty($requestData['nome'])){
        
        $dados = array(
            "tipo" => 'error',
            "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s).'
        );
    } else {
        
        $ID = isset($requestData['id']) ? $requestData['id'] : '';
        $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

        if($operacao == 'insert'){
            
            try{
                $stmt = $pdo->prepare('INSERT INTO cidadao (nome, email, foto, senha, rg) VALUES (:a, :b, :c, :d, :e)');
                $stmt->execute(array(
                    ':a' => $requestData['nome'],
                    ':b' => $requestData['email'],
                    ':c' => $requestData['foto'],
                    ':d' => md5($requestData['senha']),
                    ':e' => $requestData['rg']
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
    
            try{
                $stmt = $pdo->prepare('UPDATE cidadao SET nome = :a, email = :b, foto = :c, senha = :d, rg = :e WHERE ID = :id');
                $stmt->execute(array(
                    ':id' => $requestData['id_usuario'],
                    ':a' => $requestData['nome'],
                    ':b' => $requestData['email'],
                    ':c' => $requestData['foto'],
                    ':d' => md5($requestData['senha']),
                    ':e' => $requestData['rg']
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

    echo json_encode($dados);