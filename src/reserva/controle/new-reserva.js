$(document).ready(function() {
    $('.btn-new').click(function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Adicionar nova reserva')

        $('.modal-body').load('src/reserva/visao/form-reserva.html')
        $('.modal-body').load('src/vendedor/visao/form-vendedor.html', function(){
            $.ajax({
            dataType: 'json',
            type: 'POST',
            assync: true,
            url: 'src/tipo/modelo/all-tipo.php',
            success: function(dados){
                for(const result of dados){
                    $('#TIPO_ID').append(`<option value="${result.ID}">${result.NOME}</option>`)
                }
            }  
        })
        $('.btn-save').show()
        $('.btn-save').attr('data-operation', 'insert')
        $('#modal-reserva').modal('show')

    })

    $('.close, #close').click(function(e) {
        e.preventDefault()
        $('#modal-reserva').modal('hide')
    })
})