$(document).ready(function() {

    $('.btn-save').click(function(e) {

        e.preventDefault();

        url = "src/reserva/modelo/save-reserva.php"

        var formData = new FormData(document.getElementById("form-reserva"))

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: formData,
            url: url,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            success: function(dados) {
                Swal.fire({
                    title: 'SGQP',
                    text: dados.mensagem,
                    icon: dados.tipo,
                    confirmButtonText: 'OK'
                })

                $('#modal-reserva').modal('hide')
                $('#tabela-reserva').DataTable().ajax.reload()
            }
        })
    })

})
