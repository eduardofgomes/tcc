$('#toggle').on('click', function(){
    var rodape = $('#rodape');
    var isShow = rodape.data('show');
    console.log(isShow);
    rodape.animate({left: (isShow ? '100%': '0')}, 500, function(){
           $('#toggle').text(!isShow ? '>': '<')
    });
    rodape.data('show', !isShow);
});