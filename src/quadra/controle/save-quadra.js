$(document).ready(function() {

    $('.btn-save').click(function(e) {

        e.preventDefault();

        url = "src/quadra/modelo/save-quadra.php"

        var formData = new FormData(document.getElementById("form-quadra"))

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

                $('#modal-quadra').modal('hide')
            }
        })
    })

})