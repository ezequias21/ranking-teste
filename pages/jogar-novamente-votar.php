<style>
.container-jogar-novamente {
    height: calc(100vh - 56px);

}

.container-jogar-novamente button {
    -webkit-text-stroke-width: 0.5px;
    font-size: 1.2em;
    padding: 15px 30px;
    border-radius: 5px;
    outline: none;
    border: 2px solid white;
    color: #666;
    background-color: white;
    margin: 10px;
    cursor: pointer;
    transition: 0.5s;
}
.container-jogar-novamente button:hover{
    background-color: #ddd;
}
.container-jogar-novamente button:focus{
    color: white;
    background-color: transparent;
}

</style>
<div class="container-jogar-novamente d-flex justify-content-center align-items-center flex-column">
  <!--   <button id="jogar-novamente" class="animate" onclick="get_page_ajax('./pages/selecionar-jogador.php', './js/selecionar-jogador.js','.container-pagina-ajax')">Jogar novamente</button> -->
 <!--    <button id="jogar-novamente" class="animate" onclick="voltarPaginaRegPartida()">Jogar novamente</button> -->
    <button class="animate" onclick="voltarPaginaRegPartida()" >Jogar novamente</button>
    <button class="animate"><a href="index.php" style="display: inline-block; width: 100%; height: 100%; text-decoration: none; color: #666">voltar</a></button>
</div>