<?php


     // Upload de imagens
     if ( isset( $_FILES[ 'FOTO' ][ 'name' ] ) && $_FILES[ 'FOTO' ][ 'error' ] == 0 ) {

        $arquivo_tmp = $_FILES[ 'FOTO' ][ 'tmp_name' ];
        $nome = $_FILES[ 'FOTO' ][ 'name' ];
        
        // Pega a extensão
        $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );

        // Converte a extensão para minúsculo
        $extensao = strtolower ( $extensao );

        // Aqui eu enfileiro as extensões permitidas e separo por ';'
        if ( strstr ( '.png;.jpg;.jpeg', $extensao ) ) {
            // Cria um nome único para esta imagem
            // Evita que duplique as imagens no servidor.
            // Evita nomes com acentos, espaços e caracteres não alfanuméricos
            $novoNome = uniqid ( time () ) . '.' . $extensao;

            // Concatena a pasta com o nome
            $destino = 'arquivos/' . $novoNome;

            // tenta mover o arquivo para o destino
            if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
                
                // Scripts de persistência no banco de dados .....
                // Obter a nossa conexão com o banco de dados
                include('../../conexao/conn.php');

                // Obter os dados enviados do formulário via $_REQUEST
                $requestData = $_REQUEST;

                // Verificação de campo obrigatórios do formulário
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


                }
            }
        }
    }
    else
        $dados = array ('mensagem' => 'Você não enviou nenhum arquivo!');


    echo json_encode($dados);