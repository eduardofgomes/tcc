$(document).ready(function() {
    $('.btn-new').click(function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Adicionar novo quadra')

        $('.modal-body').load('src/quadra/visao/form-quadra.html')

        $('.btn-save').show()
        $('.btn-save').attr('data-operation', 'insert')
        $('#modal-quadra').modal('show')

    })

    $('.close, #close').click(function(e) {
        e.preventDefault()
        $('#modal-quadra').modal('hide')
    })
})