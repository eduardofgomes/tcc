$(document).ready(function() {
    $('.btn-new').click(function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Adicionar novo usuario')

        $('.modal-body').load('src/usuario/visao/form-usuario.html')

        $('.btn-save').show()
        $('.btn-save').attr('data-operation', 'insert')
        $('#modal-usuario').modal('show')

    })

    $('.close, #close').click(function(e) {
        e.preventDefault()
        $('#modal-usuario').modal('hide')
    })
})