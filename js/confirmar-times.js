

function voltarPaginaSelecJogador(){
    console.log("Voltu")
    
    get_page_ajax("./pages/selecionar-jogador.php", "./js/selecionar-jogador.js",".container-pagina-ajax")
    objJogo.modo_de_jogo.times.forEach(function(time, index){


        time.integrante.forEach(function(jogador, index){
        jogador.id = ""
        jogador.nome=""
        jogador.img_link = ""
        console.log(jogador)
       
    })
})
}



/**A função a seguir constroe o container do time e para cada time seus jogadores */
objJogo.modo_de_jogo.times.forEach(function(time, index, array){

  
    let htmlJogador = ""
    time.integrante.forEach(function(jogador, index, array){
        
        htmlJogador += ` <div class='selecionar-jogador-quadro'>
                            <input name='info' type='hidden' icon='imgs/icons/macaco.jpg' nome='sebastiao'>
                            <img src='`+ jogador.img_link +`'  class='float-left'>
                            <span><p>`+jogador.nome + `</p></span>
                        </div>`
                        
    })
    var htmlTime = `<div resultado="derrota" id_time = ` + index +` class="times container col-lg-12 d-flex flex-wrap align-items-center justify-content-center mt-5">
                        <img class="winner-img" src="imgs/winner.png">     
                        <img class="default-img" src="imgs/defeat.jpg">     
                        <h1  class="my-4 mx-2"> `+ time.nome[0] +` </h1> 
                        <div> 
                               `+htmlJogador+`
                             
                            </div>
                        </div>
                        
                    </div>`
    $('.container-confirmar-times').append(htmlTime) 
})

    
  

   $(".times").click(function(){

        $(".times .winner-img").each(function(index, element){
            $(element).removeClass("winner-img-active")/* .addClass("default-img-active") */
           
        })
        $(".times .default-img").each(function(index, element){
            $(element).addClass("default-img-active")/* .addClass("default-img-active") */
       })
      
        $(".times").attr("resultado", "derrota")
        $(this).children().eq(1).removeClass("default-img-active")
        $(this).children().first().addClass("winner-img-active")/* .removeClass("default-img-active")  */  /**Seleciona a tag imagem da div */
        $(this).attr("resultado", "vitoria")
        $("#messages-confirmar-times").css("display", "none")
   }) 


   $("#title-times").html("Informe o time vencedor")
    $("#btn-deu-empate").click(function(){
        $(".times img").each(function(index, element){
            $(element).removeClass("winner-img-active")
        })
    })


function registrarEmpate(){

    objJogo.modo_de_jogo.times.forEach(function(time){
        time.resultado = resultado["empate"]
    })

    $.ajax({
        url: 'PHP/registrar-partida.php',
        type: 'POST',
        data: objJogo,
        beforeSend: function() {
            console.log("beforeSend")
        },
        complete: function() {
            
            console.log("complete")
        },
        success: function(data) {
            console.log("succes")
            console.log("Resposta=",data)
        },
        error: function(xhr,er) {
            console.log("error")
        }
    })

    get_page_ajax("./pages/jogar-novamente-votar.php","./js/jogar-novamente-voltar.js", ".container-pagina-ajax")
}

function registrarResultadoPartida(){

    /**Armazena o resultado da partida para os times derrotados */
    $("[resultado=derrota]").each(function(){
        objJogo.modo_de_jogo.times[parseInt($(this).attr("id_time"))].resultado = resultado["derrota"]
     })
     /*Armazena o resultado da partida para o time vencedor */
    $("[resultado=vitoria]").each(function(){
        objJogo.modo_de_jogo.times[parseInt($(this).attr("id_time"))].resultado = resultado["vitoria"]
     })
}
$("#registrar-partida").click(function(){
    console.log("resgistrar-partida")
    
    if($(".winner-img-active")[0]){


        registrarResultadoPartida()

         $.ajax({
             url: 'PHP/registrar-partida.php',
             type: 'POST',
             data: objJogo,
             beforeSend: function() {
                 console.log("beforeSend")
             },
             complete: function() {
                 
                 console.log("complete")
             },
             success: function(data) {
                 console.log("succes")
                 console.log("Resposta=",data)
             },
             error: function(xhr,er) {
                 console.log("error")
             }
         }); 

         get_page_ajax("./pages/jogar-novamente-votar.php","./js/jogar-novamente-voltar.js", ".container-pagina-ajax")
    }else{
        $("#messages-confirmar-times").css("display", "block")
    }
    
})


/* function calcular_pontuacao(modos_de_jogo, timeVitoria, timeDerrota){


    let pontuacaoTimeVitoria = 0;
    let pontuacaoTimeDerrota = 0;
    
    timeVitoria.integrante.forEach(function(jogador, index){
        pontuacaoTimeVitoria+=jogador.pontuacao
        console.log("Time vitória - jogador.pontuacao=", jogador.pontuacao)
    })
  
    timeDerrota.integrante.forEach(function(jogador, index){
        pontuacaoTimeDerrota+=jogador.pontuacao
        console.log("Time Derrota - jogador.pontuacao=", jogador.pontuacao)
    })

    if(pontuacaoTimeVitoria > pontuacaoTimeDerrota){
        
        P = Math.round(Math.abs(((pontuacaoTimeDerrota/pontuacaoTimeVitoria-1)*100)/2))
        pontuacaoTimeVitoria    = +16 - P
        pontuacaoTimeDerrota = -16 + P
        
    }else{
        P = Math.round(Math.abs(((pontuacaoTimeVitoria/pontuacaoTimeDerrota-1)*100)/2))
        pontuacaoTimeVitoria =  16 + P
        pontuacaoTimeDerrota  = -16 - P
    }
  
    timeVitoria.integrante.forEach(function(jogador, index){
        console.log("4 Resultado Final Vitória=", pontuacaoTimeVitoria/ Number(timeVitoria.qtdeJogadores))
        jogador.pontuacao += Math.round(pontuacaoTimeVitoria/ Number(timeVitoria.qtdeJogadores))
        jogador.pontuacao < 0 ? jogador.pontuacao = 0 : jogador.pontuacao
        console.log("Resultado Vitória =", jogador.pontuacao)
     
    })
    timeDerrota.integrante.forEach(function(jogador, index){
        console.log("4 Resultado Final Derrota=", pontuacaoTimeDerrota/ Number(timeDerrota.qtdeJogadores))
        jogador.pontuacao += Math.round(pontuacaoTimeDerrota/ Number(timeDerrota.qtdeJogadores))
        jogador.pontuacao < 0 ? jogador.pontuacao = 0 : jogador.pontuacao 
        console.log("Resultado Derrota=", jogador.pontuacao)
    })
    

}
 */
function registrarResultado(){
 
    if($(".winner-img-active")[0]){

        /**Armazena o resultado da partida para os times derrotados */
        $("[resultado=derrota]").each(function(){
            objJogo.modo_de_jogo.times[parseInt($(this).attr("id_time"))].resultado = resultado["derrota"]
         })
         /*Armazena o resultado da partida para o time vencedor */
        $("[resultado=vitoria]").each(function(){
            objJogo.modo_de_jogo.times[parseInt($(this).attr("id_time"))].resultado = resultado["vitoria"]
         })


    }else{
        $("#messages-confirmar-times").css("display", "block")
    }
   

   /*  objJogo = {
        id_jogo: 3,
        modo_de_jogo: {
            qtdeTimes: 2,
            timesRestantes: 2,
            times = [
                {
                    jogadoresRestantes: 1,
                    nome: ["Time 1"],
                    qtdeJogadores: 1,
                    resultado: 0,
                    integrante: [
                        {
                            id: 2,
                            nome: "nickname2",
                            img_link: "imgs/icons/icon2.jpg",
                            pontuacao: 1600 
                        }
                    ]
                },
                {
                    jogadoresRestantes: 1,
                    nome: ["Time 2"],
                    qtdeJogadores: 1,
                    resultado: 0,
                    integrante: [
                        {
                            id: 2,
                            nome: "nickname3",
                            img_link: "imgs/icons/icon3.jpg",
                            pontuacao: 1600 
                        }
                    ]
                }
            ]
        }
    }
 */
}

redefinirTamanhoBackground()

