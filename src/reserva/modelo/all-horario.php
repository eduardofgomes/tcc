<?php

    include('../../conexao/conn.php');

    $sql = "SELECT * FROM HORA ORDER BY ID, HORARIO DESC";

    $resultado = $pdo->query($sql);

    if($resultado) {
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = array_map(null, $row);
        }
    }

    echo json_encode($dados);