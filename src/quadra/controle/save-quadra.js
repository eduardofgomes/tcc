$(document).ready(function() {

    $('.btn-save').click(function(e) {

        e.preventDefault();

        let dados = $('#form-quadra').serialize()

        dados += `&operacao=${$('.btn-save').attr('data-operation')}`

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: dados,
            url: 'src/quadra/modelo/save-quadra.php',
            success: function(dados) {
                Swal.fire({
                    title: 'SGQP',
                    text: dados.mensagem,
                    icon: dados.tipo,
                    confirmButtonText: 'OK'
                })

                $('#modal-quadra').modal('hide')
                $('#tabela-quadra').DataTable().ajax.reload()
            }
        })
    })

})
