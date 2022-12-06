$(document).ready(function() {

    $('#table-quadra').on('click', 'button.btn-edit', function(e) {

        e.preventDefault();

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Edição de registros')

        let ID = `ID=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: ID,
            url: 'src/quadra/modelo/view-quadra.php',
            success: function(dado) {
                if (dado.tipo == "success") {
                    $('.modal-body').load('src/quadra/visao/form-quadra.html', function() {
                        $('#NOME').val(dado.dados.NOME)
                        $('#NUMERO').val(dado.dados.NUMERO)
                        $('#BAIRRO').val(dado.dados.BAIRRO)
                        $('#LOGRADOURO').val(dado.dados.LOGRADOURO)
                        $('#ID').val(dado.dados.ID)
                    })
                    $('.btn-save').removeAttr('data-operation', 'insert')
                    $('.btn-save').show()
                    $('#modal-quadra').modal('show')
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