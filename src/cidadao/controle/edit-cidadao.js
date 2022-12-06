$(document).ready(function() {

    $('#table-cidadao').on('click', 'button.btn-edit', function(e) {

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
            url: 'src/cidadao/modelo/view-cidadao.php',
            success: function(dado) {
                if (dado.tipo == "success") {
                    $('.modal-body').load('src/cidadao/visao/form-cidadao.html', function() {
                        $('#NOME').val(dado.dados.NOME)
                        $('#EMAIL').val(dado.dados.EMAIL)
                        $('#FOTO').val(dado.dados.FOTO)
                        $('#SENHA').val(dado.dados.SENHA)
                        $('#RG').val(dado.dados.CPF)
                    })
                    $('.btn-save').removeAttr('data-operation', 'insert')
                    $('.btn-save').show()
                    $('#modal-cidadao').modal('show')
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