<?php

    include('../../conexao/conn.php');

    $requestData = $_REQUEST;

    $colunas = $requestData['columns'];

    $sql = 'SELECT QUADRAS.NOME AS QUADRA, DIA, HORARIO, CIDADAO.NOME AS CIDADAO FROM RESERVAS INNER JOIN QUADRAS ON QUADRAS.ID = QUADRAS_ID INNER JOIN DIA ON DIA.ID = DIA_ID INNER JOIN HORARIO ON HORARIO.ID = HORARIO_ID INNER JOIN CIDADAO ON CIDADAO.ID = CIDADAO_ID';

    $resultado = $pdo->query($sql);
    $qtdeLinhas = $resultado->rowCount();

    $filtro = $requestData['search']['value'];
    if( !empty( $filtro ) ){

        $sql .= " AND (QUADRA LIKE '$filtro%' ";
        $sql .= " OR DIA LIKE '$filtro%' ";
        $sql .= " OR HORARIO LIKE '$filtro%' ";
        $sql .= " OR CIDADAO LIKE '$filtro%') ";
    }
    
    $resultado = $pdo->query($sql);
    $totalFiltrados = $resultado->rowCount();
    
    $colunaOrdem = $requestData['order'][0]['column']; 
    $ordem = $colunas[$colunaOrdem]['data']; 
    $direcao = $requestData['order'][0]['dir']; 
    
    $inicio = $requestData['start']; 
    $tamanho = $requestData['length']; 
    

    $sql .= " ORDER BY $ordem $direcao LIMIT $inicio, $tamanho ";
    $resultado = $pdo->query($sql);
    $dados = array();
    while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
        //$dados[] = array_map('utf8_encode', $row);
        $dados[] = array_map(null, $row);
    }

    $json_data = array(
        "draw" => intval($requestData['draw']),
        "recordsTotal" => intval($qtdeLinhas),
        "recordsFiltered" => intval($totalFiltrados),
        "data" => $dados
    );

    echo json_encode($json_data);