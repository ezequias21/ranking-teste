$("#paginaAnterior").click(function(){
    $.ajax({
        dataType: 'html',
        url: './pages/pagina-confirmar-times.php', //link da pagina que o ajax buscará
        success: function(data) {
           /*  $(".container-pagina-ajax").html(data); //Inserindo o retorno da pagina ajax
            $.getScript("./js/confirmar-times.js", function(data, textStatus, jqxhr) {

            }) */
            console.log("Proxima págian")
        },
        error: function(data) {
            console.log("Erro Ajax")
        }
    });
})

function voltarPaginaRegPartida(){
    console.log("Selecionando próxima página")


    get_page_ajax("./pages/pagina-confirmar-times.php", "./js/confirmar-times.js", ".container-pagina-ajax")
}


$("#jogar-novamente").click(function(){
    /* get_page_ajax("./pages/selecionar-jogador.php","./js/selecionar-jogador.js", ".containter") */
    //get_page_ajax( './pages/selecionar-jogador.php', "",".containter")

      
    $.ajax
    ({
        dataType: 'html',
        url: "./pages/selecionar-jogador.php", //link da pagina que o ajax buscará
        success: function(data)
        {
            $(".container-pagina-ajax").html(data); //Inserindo o retorno da pagina ajax
             $.getScript("./js/selecionar-jogador.js",function(data, textStatus, jqxhr ){
                
            })
        },
        error: function(data){
            console.log("Erro Ajax")
        }
    });
})
redefinirTamanhoBackground()