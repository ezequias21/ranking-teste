<style>
    #btn-modo-de-jogo-voltar {
    background-color: white;
    color: #666;
    border: 2px solid white;
    padding: 10px 30px;
    outline: none;
    border-radius: 5px;
    cursor: pointer;
    -webkit-text-stroke: 1px;
    font-size: 1.4em;
    margin-bottom: 30px;
    transition: 0.5s;

}
#btn-modo-de-jogo-voltar a{
 
    color: #666;
    text-decoration: none;
}

#btn-modo-de-jogo-voltar:hover,
#btn-modo-de-jogo-voltar a:hover{
    color: white;
    background-color: transparent;
}
</style>

<link rel="stylesheet" href="./css/modoss-de-jogos1.css">


<div id="containter-modo-jogo" class="d-flex justify-content-center align-items-center">

    <div class="col-lg-10 col-xl-12 ">
        <div>
            <h1 class="text-center mt-3 mb-3">Selecione o modo de jogo<br>Time x Time</h1>
        </div>

        <div class="modo-jogo container" style="text-align: center;">
        </div>
        <div class="d-flex align-items-center justify-content-center flex-wrap">

            <button id="btn-modo-de-jogo-voltar" style="margin-top: 5rem"><a  href="index.php">voltar</a></button>
        </div>


    </div>
</div>


<script>
    var modoJogo = []
    modoJogo["1x1"] = "individual"
    modoJogo["1x1x1"] = "grupo"
    modoJogo["1x1x1x1"] = "grupo"
    modoJogo["2x2"] = "grupo"

    var tipoJogo = []
    tipoJogo["individual"] = 0
    tipoJogo["grupo"] = 1

    function determinarTipoJogo(modo) {
        console.log("Modo = ", modo)
        console.log("Modo Jogo = ", modoJogo[modo])
        console.log("Tipo = ", tipoJogo[modoJogo[modo]])
        return tipoJogo[modoJogo[modo]]
    }

    function pagina_selecionar_jogador() {

        $.ajax({
            dataType: 'html',
            url: './pages/selecionar-jogador.php', //link da pagina que o ajax buscará
            success: function(data) {
                $(".container-pagina-ajax").html(data); //Inserindo o retorno da pagina ajax
                $.getScript("./js/selecionar-jogador.js", function(data, textStatus, jqxhr) {

                })
            },
            error: function(data) {
                console.log("Erro Ajax")
            }
        });
    }

    function determinar_qtde_times() {
        $(".button-select-jogo").click(function() {
            let modo_jogo = $(this).text()
            modo_array_jogo = modo_jogo.trim().split('x')
            let tipoJogo = determinarTipoJogo(modo_jogo)

            objJogo.modo_de_jogo = {
                'qtdeTimes': modo_array_jogo.length,
                'timesRestantes': modo_array_jogo.length,
                'tipo_jogo': tipoJogo,
                times: []
            }

            modo_array_jogo.forEach(function(element, index, array) {
                jogador = []
                for (var i = 0; i < element; i++) {
                    jogador.push({
                        'id': '',
                        'nome': null,
                        'img_link': null,
                        'pontuacao': 0,
                        'id_partida': 0
                    })
                }
                nome = `Time ${index+1}`
                objJogo.modo_de_jogo.times.push({
                    'nome': [`Time ${index+1}`],
                    'integrante': jogador,
                    'qtdeJogadores': element,
                    'jogadoresRestantes': element,
                    'id_partida': 0,
                    "resultado": 2
                })
            })
            // objJogo.modo_de_jogo.times.reverse()

            console.log(objJogo)
            pagina_selecionar_jogador()


        })
    }
    $('#containter-modo-jogo').ready(function() {

        $.ajax({
            url: './PHP/get-modos-de-jogo.php',
            method: 'POST',
            data: {
                'id_jogo': objJogo.id_jogo
            },
            dataType: 'JSON',
            beforeSend: function() {
                console.log("beforeSend")
            },
            complete: function() {

                console.log("complete")
            },
            success: function(data) {
                console.log("success")
                for (let i = 0; i < data.length; i++) {
                    $(".modo-jogo").prepend("<span id='" + i + "' class='button-select-jogo'>" + data[i].modos + "</span>")
                }
                determinar_qtde_times()


            },
            error: function(xhr, er) {
                console.log("error")
            }
        });


    })


    redefinirTamanhoBackground()
</script>