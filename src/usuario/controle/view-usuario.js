$(document).ready(function() {

    $('#table-usuario').on('click', 'button.btn-view', function(e) {

        e.preventDefault();

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
                        $('#TIPO_USUARIO').attr('readonly', 'true')

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
                        $('#EMAIL').val(dado.dados.EMAIL)
                        $('#EMAIL').attr('readonly', 'true')
                        $('#LOGIN').val(dado.dados.LOGIN)
                        $('#LOGIN').attr('readonly', 'true')
                        $('#SENHA').val(dado.dados.SENHA)
                        $('#SENHA').attr('readonly', 'true')
                        
                        

                    })
                    $('.btn-save').hide()
                    $('#modal-usuario').modal('show')
                } else {
                    Swal.fire({ // Inicialização do SweetAlert
                        title: 'Sistema de gerenciamento de quadras', // Título da janela SweetAler
                        text: dado.mensagem, // Mensagem retornada do microserviço
                        type: dado.tipo, // usuario de retorno [success, info ou error]
                        confirmButtonText: 'OK'
                    })
                }
            }
        })

    })
})