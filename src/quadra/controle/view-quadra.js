$(document).ready(function() {

    $('#table-quadra').on('click', 'button.btn-view', function(e) {

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
            url: 'src/quadra/modelo/view-quadra.php',
            success: function(dado) {
                if (dado.tipo == "success") {
                    $('.modal-body').load('src/quadra/visao/form-quadra.html', function() {
                        $('#NOME').val(dado.dados.NOME)
                        $('#NOME').attr('readonly', 'true')
                        $('#NUMERO').val(dado.dados.NUMERO)
                        $('#NUMERO').attr('readonly', 'true')
                        $('#BAIRRO').val(dado.dados.BAIRRO)
                        $('#BAIRRO').attr('readonly', 'true')
                        $('#LOGRADOURO').val(dado.dados.LOGRADOURO)
                        $('#LOGRADOURO').attr('readonly', 'true')
                        $('#RESERVAS_ID').empty()

                        var RESERVAS_ID = dado.dados.RESERVAS_ID

                        //Consultar todos os tipos cadastrados no banco de daods
                        $.ajax({
                            dataType: 'json',
                            type: 'POST',
                            assync: true,
                            url: 'src/tipo/modelo/all-tipo.php',
                            success: function(dados) {
                                for (const result of dados) {
                                    if (result.ID == RESERVAS_ID) {
                                        $('#RESERVAS_ID').append(`<option value="${result.ID}">${result.NOME}</option>`)
                                    }

                                }
                            }
                        })

                    })
                    $('.btn-save').hide()
                    $('#modal-quadra').modal('show')
                } else {
                    Swal.fire({ // Inicialização do SweetAlert
                        title: 'Sistema de gerenciamento de quadras', // Título da janela SweetAler
                        text: dado.mensagem, // Mensagem retornada do microserviço
                        type: dado.tipo, // quadra de retorno [success, info ou error]
                        confirmButtonText: 'OK'
                    })
                }
            }
        })

    })
})