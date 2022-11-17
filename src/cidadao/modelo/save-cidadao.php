<?php

     // Upload de imagens

    // verifica se foi enviado um arquivo
    if ( isset( $_FILES[ 'FOTO' ][ 'name' ] ) && $_FILES[ 'FOTO' ][ 'error' ] == 0 ) {

        $arquivo_tmp = $_FILES[ 'FOTO' ][ 'tmp_name' ];
        $nome = $_FILES[ 'FOTO' ][ 'name' ];

        // Pega a extensão
        $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );

        // Converte a extensão para minúsculo
        $extensao = strtolower ( $extensao );

        // Somente imagens, .jpg;.jpeg;.gif;.png
        // Aqui eu enfileiro as extensões permitidas e separo por ';'
        // Isso serve apenas para eu poder pesquisar dentro desta String
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
                            $stmt = $pdo->prepare('INSERT INTO USUARIO (EMAIL, SENHA) VALUES (:a, :b)');
                            $stmt->execute(array(
                                ':a' => $requestData['EMAIL'],
                                ':b' => md5($requestData['SENHA'])                              
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

                        try{
                            $stmt = $pdo->prepare('SELECT *, count(ID) as encontrou FROM USUARIO ORDER BY ID DESC LIMIT 1');
                            while($resultado = $sql->fetch(PDO::FETCH_ASSOC)) {
                                if($resultado['encontrou'] == 1) {
                                    $stmt = $pdo->prepare('INSERT INTO CIDADAO (NOME, CPF, USUARIO_ID, FOTO) VALUES (:a, :b, :c, :d)');
                                        ':a' => $requestData['NOME'],
                                        ':b' => $requestData['CPF'],
                                        ':c' => $requestData['USUARIO_ID'],
                                        ':c' => $novoNome
                                } else {
                                    $dados = array(
                                        'tipo' => 'error',
                                        'mensagem' => 'Campos não preenchidos'
                                    );
                                }
                            }
                        }
                    } 
                }



                // $dados = array ('mensagem' => 'Arquivo salvo com sucesso em : ' . $destino);
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