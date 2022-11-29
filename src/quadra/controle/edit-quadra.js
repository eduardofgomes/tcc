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
                        $('#EMAIL').val(dado.dados.EMAIL)
                        $('#FOTO').val(dado.dados.FOTO)
                        $('#SENHA').val(dado.dados.SENHA)
                        $('#RG').val(dado.dados.RG)
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