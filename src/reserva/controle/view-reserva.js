$(document).ready(function() {

    $('#table-reserva').on('click', 'button.btn-view', function(e) {

        e.preventDefault();

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Visualização de registro')

        let ID = `ID=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: ID,
            url: 'src/reserva/modelo/view-reserva.php',
            success: function(dado) {
                if (dado.tipo == "success") {
                    $('.modal-body').load('src/reserva/visao/form-reserva.html', function() {
                        $('#DIA').val(dado.dados.DATA)
                        $('#DIA').attr('readonly', 'true')
                        $('#USUARIO_ID').empty()

                    })
                    $('.btn-save').hide()
                    $('#modal-reserva').modal('show')
                } else {
                    Swal.fire({ // Inicialização do SweetAlert
                        title: 'SGQP', // Título da janela SweetAler
                        text: dado.mensagem, // Mensagem retornada do microserviço
                        type: dado.tipo, // reserva de retorno [success, info ou error]
                        confirmButtonText: 'OK'
                    })
                }
            }
        })

    })
})