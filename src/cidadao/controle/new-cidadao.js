$(document).ready(function() {
    $('.btn-new').click(function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Adicionar novo cidadao')

        $('.modal-body').load('src/cidadao/visao/form-cidadao.html')

      

        $('.btn-save').show()
        $('.btn-save').attr('data-operation', 'insert')
        $('#modal-cidadao').modal('show')

    })

    $('.close, #close').click(function(e) {
        e.preventDefault()
        $('#modal-cidadao').modal('hide')
    })
})