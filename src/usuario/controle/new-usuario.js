$(document).ready(function() {
    $('.btn-new').click(function(e) {
        e.preventDefault()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('Adicionar novo usuario')
        
        $('.modal-body').load('src/usuario/visao/form-usuario.html', function(){
            $.ajax({
            dataType: 'json',
            type: 'POST',
            assync: true,
            url: 'src/tipo/modelo/all-tipo.php',
            success: function(dados){
                for(const result of dados){
                    $('#tipo_id').append(`<option value="${result.ID}">${result.NOME}</option>`)
                }
            }  
        })
    })

        $('.btn-save').show()
        $('.btn-save').attr('data-operation', 'insert')
        $('#modal-usuario').modal('show')
        
    })

    $('.close, #close').click(function(e){
        e.preventDefault()
        $('#modal-usuario').modal('hide')
    })
})