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
            url: 'src/reserva/modelo/all-quadra.php',
            success: function(dados){
                for(const result of dados){
                    $('#QUADRAS').append(`<option value="${result.ID}">${result.NOME}</option>`)
                }
            }  
        })
        $.ajax({
            dataType: 'json',
            type: 'POST',
            assync: true,
            url: 'src/reserva/modelo/all-data.php',
            success: function(dados){
                for(const result of dados){
                    $('#DIA').append(`<option value="${result.ID}">${result.DIA}</option>`)
                }
            }  
        })
        $.ajax({
            dataType: 'json',
            type: 'POST',
            assync: true,
            url: 'src/reserva/modelo/all-horario.php',
            success: function(dados){
                for(const result of dados){
                    $('#HORARIO').append(`<option value="${result.ID}">${result.HORARIO}</option>`)
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
})