$(document).ready(function() {
    $('#table-reserva').on('click', 'button.btn-delete', function(e) {


        e.preventDefault();

        let ID = `ID=${$(this).attr('id')}`

        Swal.fire({
            title: 'SGQP',
            text: 'Deseja realmente excluir esse registro?',
            icon: 'question',
            showCancelButton: true,
            confirmButton: 'sim',
            cancelButtonText: 'Não'
        }).then((result => {
            if (result.value) {

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    assync: true,
                    data: ID,
                    url: 'src/reserva/modelo/delete-reserva.php',
                    success: function(dados) {
                        Swal.fire({
                            title: 'SGQP',
                            text: dados.mensagem,
                            icon: dados.tipo,
                            confirmButtonText: 'OK'
                        })

                        $('#table-reserva').DataTable().ajax.reload()
                    }
                })
            }
        }))

    })
})