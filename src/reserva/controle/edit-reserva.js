$(document).ready(function() {

    $('#table-reserva').on('click', 'button.btn-edit', function(e) {

        e.preventDefault();

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Visualização de registros')

        let ID = `ID=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: ID,
            url: 'src/reserva/modelo/view-reserva.php',
            success: function(dado) {
                if (dado.tipo == "success") {
                    $('.modal-body').load('src/reserva/visao/login.html', function() {
                        $('#DATA').val(dado.dados.DATA)
                        $('#ID').val(dado.dados.ID)
                    })
                    $('.btn-save').removeAttr('data-operation', 'insert')
                    $('.btn-save').show()
                    $('#modal-reserva').modal('show')
                } else {
                    Swal.fire({
                        title: 'quadra',
                        text: dado.mensagem,
                        type: dado.tipo,
                        confirmButtonText: 'OK'
                    })
                }
            }
        })

    })

})