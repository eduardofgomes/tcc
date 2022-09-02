$(document).ready(function() {

    $('.btn-save').click(function(e) {

        e.preventDefault();

        let dados = $('#form-comprador').serialize()

        dados += `&operacao=${$('.btn-save').attr('data-operation')}`

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: dados,
            url: 'src/reserva/model/save-reserva.php',
            success: function(dados) {
                Swal.fire({
                    title: 'SGQP',
                    text: dados.mensagem,
                    icon: dados.tipo,
                    confirmButtonText: 'OK'
                })

                $('#modal-reserva').modal('hide')
                $('#table-reserva').DataTable().ajax.reload()
            }
        })
    })

})