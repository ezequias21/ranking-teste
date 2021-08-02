
function next() {
    let times = objJogo.modo_de_jogo.times

    for (let indexTime = 0; indexTime < times.length; indexTime++) {
        for (let indexJogador = 0; indexJogador < times[indexTime].integrante.length; indexJogador++) {
            if (times[indexTime].integrante[indexJogador].id == "") {
                console.log("Time: ", indexTime, "Jogador: ", indexJogador)
                return [indexTime, indexJogador]
            }
        }
    }
    return null
}


$(".selecionar-jogador-quadro").each(function(){
    jQuery.data($(this)[0], "record", {
        time: 0,
        jogador: 0,
        clicado: false
    })
})


function append(card, record){
    $(card).append(`<div class='mark animate'>
                        <p>Time: ${record[0] + 1}</p>
                        <p>Jogador: ${record[1] + 1}</p>
                    </div>`)
            .addClass("escolhido")
}

function remove(card){
    $(card).removeClass("escolhido")
            .find(".mark").remove()
}

function idJogador(card){
    return parseInt($(card).attr("id_usuario"))
}
function nomeJogador(card){
    return $(card).find("[name=info]").attr("nome")
}
function iconJogador(card){
    return $(card).find("[name=info]").attr("icon")
}
function escreverTitulo(titulo){
    $("#time-titulo").html(titulo)
}

function nomeTime(record){
    if(record){
        escreverTitulo(`Selecione o jogador do Time ${record[0] + 1}`)
    }else{
        escreverTitulo("Pode avançar")
    }
}
function preecherJogador(card, record){
    if(record){
        objJogo.modo_de_jogo.times[record[0]].integrante[record[1]].id = idJogador(card)
        objJogo.modo_de_jogo.times[record[0]].integrante[record[1]].nome = nomeJogador(card)
        objJogo.modo_de_jogo.times[record[0]].integrante[record[1]].img_link = iconJogador(card)
    }
}


function proximaPagina(){
}

$("#button-confirmar").click(function(){
   
    if(!next()){
        get_page_ajax("./pages/pagina-confirmar-times.php", "./js/confirmar-times.js", ".container-pagina-ajax")
    }
})
function escreverMensagem(mensagem){
    $("#messages").html(mensagem)
}
function verificarEscolhaTerminou(){
    if(!next()){
        $("#button-confirmar").prop( "disabled", false )
                              .css("opacity", "1")
        escreverMensagem("Todos os jogadores já foram escolhidos! Clique em avançar.")
    }else{
        $("#button-confirmar").prop( "disabled", true )
                              .css("opacity", "0.6")
        escreverMensagem("Selecione todos os jogadores")
    }
} 
nomeTime([0,0])
verificarEscolhaTerminou()
function clickCard(card){
    console.log("Click card")

    
    
    if(jQuery.data(card, "record").clicado) {
        let time =  jQuery.data(card, "record").time
        let jogador =  jQuery.data(card, "record").jogador
        jQuery.data(card, "record").clicado = false
        console.log("O card será zerado =", time, ", ", jogador)
        objJogo.modo_de_jogo.times[time].integrante[jogador].id =""
        nomeTime(next())
        remove(card)
        
    }else{
        let record = next()
        if(record){
            let time = record[0]
            let jogador = record[1]
            console.log("O card será registrado =", time, ", ", jogador)
            jQuery.data(card, "record").time = time
            jQuery.data(card, "record").jogador = jogador
            jQuery.data(card, "record").clicado = true
            preecherJogador(card, record)
            append(card, record)
            nomeTime(next())
            
        }
        
    }
    verificarEscolhaTerminou()
}

$(".selecionar-jogador-quadro").click(function(){
    clickCard($(this)[0])
})
function limparJogadoresEscolhidos(){
  
    objJogo.modo_de_jogo.times.forEach(function(time, index){


        time.integrante.forEach(function(jogador, index){
        jogador.id = ""
        jogador.nome=""
        jogador.img_link = ""
      
       
    })
})
}
function voltarPaginaModoDeJogo(){
    limparJogadoresEscolhidos()
    $.ajax
    ({
        dataType: 'html',
        url: "pages/modo_de_jogo.php",
        success: function(data)
        {
            $(".container-pagina-ajax").html(data); //Inserindo o retorno da pagina ajax
        },
        error: function(data){
            console.log("Erro Ajax")
        }
    }); 
}



