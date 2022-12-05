<?php


     // Upload de imagens

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
                            $stmt = $pdo->prepare('INSERT INTO QUADRA (EMAIL, SENHA, TIPO_ID) VALUES (:a, :b, :c)');
                            $stmt->execute(array(
                                ':a' => $requestData['NOME'],
                                ':b' => $requestData['NUMERO'],
                                ':c' => $requestData['BAIRRO'],
                                ':d' => $requestData['LOGRADOURO'],
                                ':e' => $USUARIO_ID,
                                ':f' => $novoNome                             
                            ));
                            $sql = 'SELECT ID FROM USUARIO ORDER BY ID DESC LIMIT 1';
                            $resultado = $pdo->query($sql);
                            while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
                                $USUARIO_ID = $row['ID'];
                            }
                                    $stmt = $pdo->prepare('INSERT INTO QUADRA (NOME, CPF, USUARIO_ID, FOTO) VALUES (:a, :b, :c, :d)');
                                    $stmt->execute(array(
                                        ':a' => $requestData['NOME'],
                                        ':b' => $requestData['NUMERO'],
                                        ':c' => $requestData['BAIRRO'],
                                        ':d' => $requestData['LOGRADOURO'],
                                        ':e' => $USUARIO_ID,
                                        ':f' => $novoNome
                                    ));

                            $dados = array(
                                "tipo" => 'success',
                                "mensagem" => 'Cidadão cadastrado com sucesso.'
                            );

                   

                        } catch(PDOException $e) {
                            $dados = array(
                                "tipo" => 'error',
                                "mensagem" => 'Não foi possível efetuar o cadastro do cidadão.'
                            );
                        }

                    } 


                }
            }
            else
                $dados = array ('mensagem' => 'Erro ao salvar o arquivo. Aparentemente você não tem permissão para editar essa área.');
        }
        else
            $dados = array ('mensagem' => 'Você poderá enviar apenas arquivos "*.JPG, PNG ou JPEG"');
    }
    else
        $dados = array ('mensagem' => 'Você não enviou nenhum arquivo!');


    echo json_encode($dados);