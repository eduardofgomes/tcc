$(document).ready(function() {

    $('#table-cidadao').on('click', 'button.btn-view', function(e) {

        e.preventDefault();

        /*$(body).append(`<script src="src/cidadao/controle/foto.js"></script>
        <script src="src/cidadao/controle/mascara-cpf.js"></script>`)*/

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
                        $('#SENHA').val(dado.dados.SENHA)
                        $('#SENHA').attr('readonly', 'true')
                        $('#CPF').val(dado.dados.CPF)
                        $('#CPF').attr('readonly', 'true')
                        $('#FOTO').val(dado.dados.FOTO)
                        $('#FOTO').attr('readonly', 'true')
                    })
                    
                    $('.btn-save').hide()
                    $('#modal-cidadao').modal('show')
                } else {
                    Swal.fire({ // Inicialização do SweetAlert
                        title: 'Sistema de gerenciamento de quadras', // Título da janela SweetAler
                        text: dado.mensagem, // Mensagem retornada do microserviço
                        type: dado.tipo, // cidadao de retorno [success, info ou error]
                        confirmButtonText: 'OK'
                    })
                }
            }
        })

    })
})