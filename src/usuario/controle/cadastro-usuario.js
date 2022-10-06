$(document).ready(function() {

    $('.btn-login').click(function(e) {

        e.preventDefault();

        let dados = $('#form-login').serialize()

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: dados,
            url: 'src/usuario/modelo/cadastro-usuario.php',
            success: function(dados) {
                if(dados.tipo == 'success') {
                    $(location).attr('href', 'cadastro.html')
                } else {
                    Swal.fire({
                        title: 'SGQP',
                        text: dados.mensagem,
                        icon: dados.tipo,
                        confirmButtonText: 'OK'
                    })
                }
            }
        })
    })

})