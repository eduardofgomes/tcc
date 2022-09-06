$(document).ready(function() {

    $('#table-usuario').on('click', 'button.btn-edit', function(e) {

        e.preventDefault()

        // Alterar as informações do modal para apresentação dos dados

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Visualização de registro')

        let ID = `ID=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: ID,
            url: 'src/usuario/modelo/view-usuario.php',
            success: function(dado) {
                if (dado.tipo == "success") {
                    $('.modal-body').load('src/usuario/visao/form-usuario.html', function() {
                        switch (dado.dados.TIPO_USUARIO) {
                            case 1:
                                $('#TIPO_USUARIO').append(`<option value="1">Usuário</option>`)
                            break;
                            case 2:
                                $('#TIPO_USUARIO').append(`<option value="2">ADM</option>`)
                            break;
                            case 3:
                                $('#TIPO_USUARIO').append(`<option value="3">Zelador</option>`)
                                break;
                        }
                        $('#NOME').val(dado.dados.NOME)
                        $('#EMAIL').val(dado.dados.EMAIL)
                        $('#LOGIN').val(dado.dados.LOGIN)
                        $('#SENHA').val(dado.dados.SENHA)
                        $('#ID').val(dado.dados.ID)
                    })
                    $('.btn-save').show()
                    $('.btn-save').removeAttr('data-operation')
                    $('#modal-usuario').modal('show')
                } else {
                    Swal.fire({ // Inicialização do SweetAlert
                        title: 'Sistema de gerenciamento de quadras', // Título da janela SweetAlert
                        text: dado.mensagem, // Mensagem retornada do microserviço
                        type: dado.tipo, // usuario de retorno [success, info ou error]
                        confirmButtonText: 'OK'
                    })
                }
            }
        })

    })
})