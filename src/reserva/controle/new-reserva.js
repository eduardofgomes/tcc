$(document).ready(function() {
    $('.btn-new').click(function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Adicionar nova reserva')

        $('.modal-body').load('src/reserva/visao/form-reserva.html')

        $('.btn-save').show()
        $('.btn-save').attr('data-operation', 'insert')
        $('#modal-reserva').modal('show')

    })

    $('.close, #close').click(function(e) {
        e.preventDefault()
        $('#modal-reserva').modal('hide')
    })
})