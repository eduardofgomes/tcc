<?php
                if(empty($requestData['NOME'])){
                    // Caso a variável venha vazia eu gero um dados de erro do mesmo
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
                            $TIPO_CIDADAO = '2';
                            $stmt = $pdo->prepare('INSERT INTO QUADRA (NOME, NUMERO, BAIRRO, LOGRADOURO) VALUES (:a, :b, :c, :d, :e)');
                            $stmt->execute(array(
                                ':a' => $requestData['NOME'],
                                ':b' => $requestData['NUMERO'],
                                ':c' => $requestData['BAIRRO'],
                                ':d' => $requestData['LOGRADOURO']                       
                            ));
                          
                            
                                    $stmt = $pdo->prepare('INSERT INTO QUADRA (NOME, NUMERO, BAIRRO, LOGRADOURO) VALUES (:a, :b, :c, :d)');
                                    $stmt->execute(array(
                                        ':a' => $requestData['NOME'],
                                        ':b' => $requestData['NUMERO'],
                                        ':c' => $requestData['BAIRRO'],
                                        ':d' => $requestData['LOGRADOURO']
                                    ));

                            $dados = array(
                                "tipo" => 'success',
                                "mensagem" => 'Quadra cadastrado com sucesso.'
                            );

                   
                            
                        } catch(PDOException $e) {
                            $dados = array(
                                "tipo" => 'error',
                                "mensagem" => 'Não foi possível criar a quadra.'
                            );
                        }

                    } 
        
                } else {
                    $dados = array ('mensagem' => 'Erro ao salvar o arquivo. Aparentemente você não tem permissão para editar essa área.');
                }
    
        


    echo json_encode($dados);