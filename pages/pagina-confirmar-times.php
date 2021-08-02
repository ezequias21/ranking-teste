<link rel="stylesheet" href="./css/confirmar-times.css">
<link rel="stylesheet" href="./css/selecionar-jogador3.css">
<!-- <h2> Confirmar Times</h2>

<div class="container-times">
<div class="container-confirmar-times">
    


</div>
<button id="confirmar-times"> Confirmar times</button>
<button id="registrar-partida" style="display: none"> Registrar partida</button>


</div> -->
<!--O novo começa aqui-->
<div class="d-flex justify-content-center align-items-center">

        <div class="col-lg-10 col-xl-12 ">
            <div>
                <h1 id="title-times" class="text-center mt-3 mb-3">Confirme os times</h1>
            </div>

            <div class="container-confirmar-times">

            </div>

            <div class="d-flex align-items-center justify-content-center flex-column">
                <p id="messages-confirmar-times" class="tremer">Você ainda não informou o time vencedor.</p>
             <!--    <button id="confirmar-times" class="animate" style="margin-top: 30px">Confirmar Times</button> -->
                <button id="btn-deu-empate" class="animate"style="display: block; margin-top: 30px" onclick="registrarEmpate()">Deu empate</button>
                <div class="d-flex justify-content-center flex-wrap">
                    <button id="btn-voltar" class="animate" onclick="voltarPaginaSelecJogador()" >Voltar</button>
                    <button id="registrar-partida" class="animate" style="display: block"> Registrar partida</button>

                </div>
            </div>
        </div>
</div>