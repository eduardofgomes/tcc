<?php

     * Upload de imagens

    // verifica se foi enviado um arquivo
    if ( isset( $_FILES[ 'ARQUIVO' ][ 'name' ] ) && $_FILES[ 'ARQUIVO' ][ 'error' ] == 0 ) {

        $arquivo_tmp = $_FILES[ 'ARQUIVO' ][ 'tmp_name' ];
        $nome = $_FILES[ 'ARQUIVO' ][ 'name' ];

        // Pega a extensão
        $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );

        // Converte a extensão para minúsculo
        $extensao = strtolower ( $extensao );

        // Somente imagens, .jpg;.jpeg;.gif;.png
        // Aqui eu enfileiro as extensões permitidas e separo por ';'
        // Isso serve apenas para eu poder pesquisar dentro desta String
        if ( strstr ( '.pdf', $extensao ) ) {
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
                if(empty($requestData['TITULO'])){
                    // Caso a variável venha vazia eu gero um retorno de erro do mesmo
                    $dados = array(
                        "tipo" => 'error',
                        "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s).'
                    );
                } else {
                    // Caso não exista campo em vazio, vamos gerar a requisição
                    $ID = isset($requestData['ID']) ? $requestData['ID'] : '';
                    $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

                    // Verifica se é para cadastra um nvo registro
                    if($operacao == 'insert'){
                        // Prepara o comando INSERT para ser executado
                        try{
                            $stmt = $pdo->prepare('INSERT INTO CIDADAO (NOME, EMAIL, SENHA, RG, FOTO) VALUES (:a, :b, :c, :d, :e)');
                            $stmt->execute(array(
                                ':a' => utf8_decode($requestData['NOME']),
                                ':b' => $requestData['EMAIL'],
                                ':c' => md5($requestData['SENHA']),
                                ':d' => utf8_decode($requestData['RG']),
                                ':e' => $novoNome
                            ));

                            // Início da busca dos último cadastro efetivado
                            $sql = $pdo->query("SELECT * FROM CIDADAO ORDER BY ID DESC LIMIT 1");
                
                            while ($resultado = $sql->fetch(PDO::FETCH_ASSOC)) {
                                $ID = $resultado['ID'];
                            }

                            $indice = count(array_filter($requestData['USUARIO_ID']));

                            for($i=0; $i < $indice; $i++) {
                                $stmt = $pdo->prepare('INSERT INTO AUTOR (TRABALHO_IDTRABALHO, USUARIO_IDUSUARIO) VALUES (:a, :b)');
                                $stmt->execute(array(
                                    ':a' => $ID,
                                    ':b' => $requestData['USUARIO_IDUSUARIO'][$i]
                                ));
                            }

                            $retorno = array(
                                "tipo" => 'success',
                                "mensagem" => 'Trabalho cadastrado com sucesso.'
                            );
                        } catch(PDOException $e) {
                            $retorno = array(
                                "tipo" => 'error',
                                "mensagem" => 'Não foi possível efetuar o cadastro do trabalho.'
                            );
                        }
                    } else {
                        // Se minha variável operação estiver vazia então devo gerar os scripts de update
                        try{
                            $stmt = $pdo->prepare('UPDATE TRABALHO SET NOME = :a, EMAIL = :b, SENHA = :c, RG = :d, ORIENTADOR = :e WHERE IDTRABALHO = :id');
                            $stmt->execute(array(
                                ':id' => $ID,
                                ':a' => utf8_decode($requestData['NOME']),
                                ':b' => $requestData['EMAIL'],
                                ':c' => md5($requestData['SENHA']),
                                ':d' => utf8_decode($requestData['RG']),
                                ':e' => $novoNome
                            ));

                            $retorno = array(
                                "tipo" => 'success',
                                "mensagem" => 'Trabalho atualizado com sucesso.'
                            );
                        } catch (PDOException $e) {
                            $retorno = array(
                                "tipo" => 'error',
                                "mensagem" => 'Não foi possível efetuar o alteração do trabalho.'
                            );
                        }
                    }
                }

                // $retorno = array ('mensagem' => 'Arquivo salvo com sucesso em : ' . $destino);
            }
            else
                $retorno = array ('mensagem' => 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.');
        }
        else
            $retorno = array ('mensagem' => 'Você poderá enviar apenas arquivos "*.PDF"');
    }
    else
        $retorno = array ('mensagem' => 'Você não enviou nenhum arquivo!');


    echo json_encode($retorno);