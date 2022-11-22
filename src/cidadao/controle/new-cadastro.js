$(document).ready(function() {
    $('.btn-cadastro').click(function(e) {
        e.preventDefault()

        $('.card-cadastro').empty()

        $('.card-cadastro').load('src/cidadao/visao/form-cidadao.html')
    })
})