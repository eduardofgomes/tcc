$(document).ready(function() {
    $('#table-cidadao').on('click', 'button.btn-delete', function(e) {

        e.preventDefault();

        let ID = `ID=${$(this).attr('id')}`

        Swal.fire({
            title: 'quadra',
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
                    url: 'src/cidadao/modelo/delete-cidadao.php',
                    success: function(dados) {
                        Swal.fire({
                            title: 'SGQP',
                            text: dados.mensagem,
                            icon: dados.tipo,
                            confirmButtonText: 'OK'
                        })

                        $('#table-cidadao').DataTable().ajax.reload()
                    }
                })
            }
        }))

    })
})