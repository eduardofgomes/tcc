$(document).ready(function() {
    $('#table-reserva').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "src/reserva/modelo/list-reserva.php",
            "type": "POST"
        },
        "language": {
            "url": "libs/DataTables/pt_br.json"
        },
        "columns": [{
                "data": 'QUADRA',
                "className": 'text-center'
            },
            {
                "data": 'DIA',
                "className": 'text-center'
            },
            {
                "data": 'HORARIO',
                "className": 'text-center'
            },
            {
                "data": 'CIDADAO',
                "className": 'text-center'
            }
        ]
    })
})