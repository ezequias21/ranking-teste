
<style>
    .mark {
    position: absolute;
    color: white;
    background-color: #4d4d4d;
    border-radius: 5px;
    right: -8px;
    bottom: -9px;
    font-size: 0.9rem;
}

.mark p {
    margin-bottom: 0;
}
.selecionar-jogador-quadro{
    position: relative;
}
#voltar-modo-de-jogo {
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

#voltar-modo-de-jogo:hover, #voltar-modo-de-jogo a:hover {
    color: white;
    background-color: transparent;
}
</style>
<div class="d-flex justify-content-center">

        <div class="">
            <div>
                <h1 id="time-titulo"class="text-center mt-3 mb-3">Selecione o jogador do <span id="time"></span></h1>
            </div>

            <div class="d-flex flex-wrap justify-content-center mt-5">

    <?php
    require "../config.php";
        $sql = "SELECT * FROM usuario";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            while($obj = $result->fetch_object()){

                
                echo "<div id_usuario= '" .$obj->id ."'class='selecionar-jogador-quadro'>
                <input name='info'type='hidden' id_usuario='" .$obj->id ."' icon='" . $obj->icon. "' nome='". $obj->nickname . "' >
                <img src='" . $obj->icon. "' class='float-left'>
                <span><p> " . $obj->nickname . "</p></span>
                </div>"; 
                    
            }

    
        }else{
            echo "<h3>Nenhum usuario cadastrado.</h3>";
        }
    ?>
 
        </div>
            <div class="d-flex align-items-center justify-content-center flex-column">
                <p class="col-sm-12 col-lg-6 col-xl-6 " id="messages"></p><br>
                <div class="d-flex align-items-center justify-content-center flex-wrap">

                    <button id="voltar-modo-de-jogo" onclick="voltarPaginaModoDeJogo()" class="animate" style="margin: 0 10px;">voltar</a></button>
                    <button id="button-confirmar" class="animate" style="margin: 0 10px;">Avançar</button>
                </div>

            </div>
        </div>
    </div>
    
    


