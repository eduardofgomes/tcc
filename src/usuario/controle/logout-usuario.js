$(document).ready(function() {

    $('#logout').click(function(e){
        e.preventDefault();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        assync: true,
        url: 'src/usuario/modelo/logout-usuario.php',
        success: function(dados) {
            if(dados.tipo == 'success') {
                $(location).attr('href', 'index.html')
            } else {
                Swal.fire({
                    title: 'e-rifa',
                    text: dados.mensagem,
                    icon: dados.tipo,
                    confirmButtonText: 'OK'
                })
            }
        }
    })
    })
})