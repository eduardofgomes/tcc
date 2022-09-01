$(document).ready(function() {

    $('#table-cidadao').on('click', 'button.btn-view', function(e) {

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
            url: 'src/cidadao/modelo/view-cidadao.php',
            success: function(dado) {
                if (dado.tipo == "success") {
                    $('.modal-body').load('src/cidadao/visao/form-cidadao.html', function() {
                        $('#NOME').val(dado.dados.NOME)
                        $('#NOME').attr('readonly', 'true')
                        $('#EMAIL').val(dado.dados.EMAIL)
                        $('#EMAIL').attr('readonly', 'true')
                        $('#FOTO').val(dado.dados.FOTO)
                        $('#FOTO').attr('readonly', 'true')
                        $('#SENHA').val(dado.dados.SENHA)
                        $('#SENHA').attr('readonly', 'true')
                        $('#RG').val(dado.dados.RG)
                        $('#RG').attr('readonly', 'true')
                        $('#USUARIO_ID').empty()

                        var USUARIO_ID = dado.dados.USUARIO_ID

                        //Consultar todos os tipos cadastrados no banco de daods
                        $.ajax({
                            dataType: 'json',
                            type: 'POST',
                            assync: true,
                            url: 'src/tipo/modelo/all-tipo.php',
                            success: function(dados) {
                                for (const result of dados) {
                                    if (result.ID == USUARIO_ID) {
                                        $('#USUARIO_ID').append(`<option value="${result.ID}">${result.NOME}</option>`)
                                    }

                                }
                            }
                        })

                    })
                    $('.btn-save').hide()
                    $('#modal-cidadao').modal('show')
                } else {
                    Swal.fire({ // Inicialização do SweetAlert
                        title: 'e-Rifa', // Título da janela SweetAler
                        text: dado.mensagem, // Mensagem retornada do microserviço
                        type: dado.tipo, // cidadao de retorno [success, info ou error]
                        confirmButtonText: 'OK'
                    })
                }
            }
        })

    })
})