<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
<link rel="stylesheet" href="../css/home.css">
<link rel="stylesheet" href="../css/paginator.css">
<link rel="stylesheet" href="../css/mini-card.css">
<link rel="stylesheet" href="../css/ranking1.css">


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://kit.fontawesome.com/97577a5cf9.js" crossorigin="anonymous"></script>
<style>
    /*Estilos para o background*/
.background-icons {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
}

i {
    padding: 20px;
    color: #666;
    font-size: 2.8rem;
    z-index: -10;
    opacity: 0.05;
}
i:hover{
    color: #666;
}

/*Fim dos estilos do background*/

/**Estilos da tabela partida */
.container-partidas{
    position: relative;
}
/**Fim dos estilos da tabela partida */


.card-usuario {
    position: absolute;
    top: -138px;
    left: 0;
    background-color: transparent;
    width: 10rem;
    height: 11rem;
    perspective: 1000px;
    margin: 10px;
  z-index: 1;
  }
  .card-inner{
      
      position: relative;
      cursor: pointer;
      background-color: #4d4d4d;
      border-radius: 5px;
      z-index: 3;
      width: 100%;
      height: 100%;
      /* text-align: center; */
      transition: transform 0.6s;
      transform-style: preserve-3d;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  
  }
  .card-usuario:hover .card-inner{
    transform: rotateY(180deg);
  }
  .card-usuario-front, .card-usuario-back {
    position: absolute;
    display: flex;
      justify-content: space-evenly;
      flex-direction: column;
      align-items: center;
    width: 100%;
    height: 100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
  }
  .card-usuario-back{
      transform: rotateY(180deg);   
  }
  .card-usario-image {
      width: 5rem;
      height: 5rem;
  }
  .card-usario-image img {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      border: 1px solid #ddd;
  }
  .card-content {
  
      padding: 13px 23px;
      border-radius: 30px;
      color: white;
      font-size: 1.3rem;
    
  }
  .table-title {
    position: absolute;
    background-color: #4d4d4d;
    right: 10px;
    color: white;
    font-size: 1.5rem;
    padding: 10px 20px;
    border-radius: 23px 20px 0px 0px;
    top: -55px;
    cursor: pointer;
}
li{
    list-style-type: none;
}
.img-game-icon {
    width: 9rem;
    height: 5rem;
    border-radius: 5px;
}
.time-icon {
    padding: 10px;
    width: 198px;
    background-color: #ddd;
}
img {
    width: 2.9rem;
    height: 2.9rem;
    object-fit: cover;
    border-radius: 50px;
}

.img-icon span {
    background-color: #ddd;
    padding: 10px;
    border-radius: 0 10px 10px 0;
}
tr{
    vertical-align: baseline;
}
li{
    margin-left: auto;
    margin-right: auto;
}
.active-item-menu{
    background-color: #ddd;
}
.content{
    background-color: white;
    border-radius: 5px;
}
.table-header-title {
    font-size: 1.4rem;
    background-color: #4d4d4d;
    color: #ddd;
    padding: 8px;
    border-radius: 20px 20px 0 0;
    margin-left: 10px;
    margin-right: 10px;
    text-align: center;
}

.icon-usuario-ranking {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 50px;
      margin-right: 5px;
  }
</style>
</head>
<body>
<div class="bar-header" style="box-shadow: 13px 8px 15px -12px rgba(0, 0, 0, 0.36);">
    <a href="../pages/usuario.php"style="text-align: center;" class="buttton-ranking">Voltar </a>
</div>
<!--Background de ícones-->
<div class="background-icons" style="overflow: hidden">
  </div>
  <main>

        <div class="container col-lg-6 mb-5" style="margin-top: 200px">

        <div class="container-partidas">
            <div id_usuario="2" class="card-usuario">
                <div class="card-inner">
                    <div class="card-usuario-front">
                        <div class="card-usario-image">
                            <img src="../imgs/icons/icon2.jpg">
                        </div>
                        <div class="card-content">
                            <p style="margin-bottom: 0">nickname2</p>
                        </div> 
                    </div>
                </div>   
            </div>
            
            <div class="table-title active-item-menu">
                <p style="margin-bottom: 0">Partidas recentes</p>
            </div>
            <div class="table-title" style="right: 210px">
                <p style="margin-bottom: 0">Ranking</p>
            </div>      
            <div class="content d-flex flex-wrap justify-content-center align-items-center p-4 mb-4" style="box-shadow: 4px 3px 14px 3px rgba(0,0,0,0.28);">
                
                <div id_jogo="3" nome_jogo="xadrez" class="mini-card">
                    <div class="mini-card-icone">
                        <img src="../imgs/xadrez.jpg">
                    </div>
                    <div class="title">xadrez</div>
                </div>

                <div id_jogo="4" nome_jogo="dama" class="mini-card">
                  <div class="mini-card-icone">
                      <img src="../imgs/dama.jpeg">
                  </div>
                      <div class="title">dama</div>
                </div>

                <div id_jogo="115" nome_jogo="Cartas" class="mini-card active">
                  <div class="mini-card-icone">
                      <img src="../imgs/imgs_jogos/60e5f41fc00489.45473441.jpg">
                  </div>
                      <div class="title">Cartas</div>
                </div>

                <div id_jogo="1" nome_jogo="ludo" class="mini-card">
                  <div class="mini-card-icone">
                      <img src="../imgs/ludo.png">
                  </div>
                      <div class="title">ludo</div>
                </div>

                <div id_jogo="5" nome_jogo="sinuca" class="mini-card">
                  <div class="mini-card-icone">
                      <img src="../imgs/sinuca.jpg">
                  </div>
                      <div class="title">sinuca</div>
                </div>

            </div>
            <div class="table-header-title mt-5">Ranking</div>
            <table class="table table-striped">
      <thead>
        
         <tr>
          <th class="align-middle" scope="col">Pontuação</th>
          <th class="align-middle" scope="col">Tipo</th>
          <th class="align-middle" scope="col">Derrotas</th>
          <th class="align-middle" scope="col">Empates</th>
          <th class="align-middle" scope="col">Vitória</th>
          <th class="align-middle" scope="col">Streak</th>
        </tr>

      </thead>
      <tbody>
        <tr>
        <!-- <th data-title=" scope=" row=""><img class="trofeu" src="../imgs/medal-ouro.png" alt="Trofeu ouro"></th> -->
      <!--   <td data-title="Jogador"><img class="icon-usuario-ranking" src="../imgs/icons/macaco.jpg"><span>nickname5</span></td> -->
        <td data-title="Pontuação">1632</td>
        <td data-title="Tipo">Individual</td>
        <td data-title="Vitória">10</td>
        <td data-title="Empates">0</td>
        <td data-title="Derrotas">2</td>
        <td data-title="Streak">0</td>
        
        </tr>

        <tr>
        <!-- <th  data-title=" scope=" row=""><img class="trofeu" src="../imgs/medal-prata.png" alt="Trofeu ouro"></th>
        <td  data-title="Jogador"><img class="icon-usuario-ranking" src="../imgs/icons/coelho.jpg"><span>nickname3</span></td> -->
        <td  data-title="Pontuação">1616</td>
        <td  data-title="Partidas">Em grupo</td>
        <td  data-title="Vitória">5</td>
        <td  data-title="Empates">1</td>
        <td  data-title="Derrotas">10</td>
        <td data-title="Streak">2</td>
        </tr>
        

    </tbody>
    </table>
      


    <div class="table-header-title mt-5">Aliados frequentes</div>
            <table class="table table-striped">
      <thead>
        <tr>
          <th class="align-middle" scope="col">Player</th>
          <th class="align-middle" scope="col">Partidas</th>
          <th class="align-middle" scope="col">Vitórias</th>
          <th class="align-middle" scope="col">Derrotas</th>
        </tr>
      </thead>
      <tbody>
        <tr>
        <!-- <th data-title=" scope=" row=""><img class="trofeu" src="../imgs/medal-ouro.png" alt="Trofeu ouro"></th> -->
      <!--   <td data-title="Jogador"><img class="icon-usuario-ranking" src="../imgs/icons/macaco.jpg"><span>nickname5</span></td> -->
      <td data-title="Pontuação">
            <img class="icon-usuario-ranking" src="../imgs/icons/macaco.jpg">
            <span>nickname5</span>
        </td>
        <td data-title="Tipo">10</td>
        <td data-title="Vitória">2</td>
        <td data-title="Empates">4</td>
        </tr>

        <tr>
        <!-- <th  data-title=" scope=" row=""><img class="trofeu" src="../imgs/medal-prata.png" alt="Trofeu ouro"></th>
        <td  data-title="Jogador"><img class="icon-usuario-ranking" src="../imgs/icons/coelho.jpg"><span>nickname3</span></td> -->
        <td data-title="Pontuação">
            <img class="icon-usuario-ranking" src="../imgs/icons/macaco.jpg">
            <span>nickname5</span>
        </td>
        <td data-title="Tipo">10</td>
        <td data-title="Vitória">2</td>
        <td data-title="Empates">4</td>
        </tr>
        

    </tbody>
    </table>


    <div class="table-header-title mt-5">Oponentes frequentes</div>
            <table class="table table-striped">
      <thead>
        <tr>
          <th class="align-middle" scope="col">Player</th>
          <th class="align-middle" scope="col">Partidas</th>
          <th class="align-middle" scope="col">Vitórias</th>
          <th class="align-middle" scope="col">Derrotas</th>

        </tr>
      </thead>
      <tbody>
        <tr>
        <!-- <th data-title=" scope=" row=""><img class="trofeu" src="../imgs/medal-ouro.png" alt="Trofeu ouro"></th> -->
      <!--   <td data-title="Jogador"><img class="icon-usuario-ranking" src="../imgs/icons/macaco.jpg"><span>nickname5</span></td> -->
        <td data-title="Pontuação">
            <img class="icon-usuario-ranking" src="../imgs/icons/macaco.jpg">
            <span>nickname5</span>
        </td>
        <td data-title="Tipo">10</td>
        <td data-title="Vitória">2</td>
        <td data-title="Empates">4</td>

        
        </tr>

        <tr>
        <!-- <th  data-title=" scope=" row=""><img class="trofeu" src="../imgs/medal-prata.png" alt="Trofeu ouro"></th>
        <td  data-title="Jogador"><img class="icon-usuario-ranking" src="../imgs/icons/coelho.jpg"><span>nickname3</span></td> -->
        <td data-title="Pontuação">
            <img class="icon-usuario-ranking" src="../imgs/icons/macaco.jpg">
            <span>nickname5</span>
        </td>
        <td data-title="Tipo">10</td>
        <td data-title="Vitória">2</td>
        <td data-title="Empates">4</td>
        </tr>
        

    </tbody>
    </table>
            
        </div>
        </div>
    </main>
  <!--Fim do background de ícones-->
</body>   
<script>
    $("document").ready(function(){
        function redefinirTamanhoBackground(){
    var widthBody = $("body").css("width")
    var heightBody = $(".container").height()
    var marginbottom = $(".container").css("margin-bottom").split(``).filter(n => Number(n) || n == false).join(``)
    var height = parseInt(heightBody) + parseInt(marginbottom) ;
    height < $(window).height() - 56 ?  height = $(window).height() - 56 : height
    $(".background-icons").css({
        "width": widthBody,
        "height": height + "px"
    })
    console.log("widthBody=",widthBody, "heightBody", heightBody, "margin-bottom= ", marginbottom, "height=",height)
}

let icons = [
            "<i class='fas fa-chess-board'></i>",
            "<i class='fas fa-chess-rook'></i>",
            "<i class='fas fa-chess-queen'></i>",
            "<i class='fas fa-chess-pawn'></i>",
            "<i class='fas fa-chess-knight'></i>",
            "<i class='fas fa-chess-king'></i>",
            "<i class='fas fa-chess-bishop'></i>",
            "<i class='fas fa-chess'></i>",
            "<i class='fas fa-trophy'></i>",
            "<i class='fas fa-dice'></i>",
            "<i class='fas fa-dice-one'></i>",
            "<i class='fas fa-dice-two'></i>",
            "<i class='fas fa-dice-three'></i>",
            "<i class='fas fa-dice-four'></i>",
            "<i class='fas fa-dice-five'></i>",
            "<i class='fas fa-dice-six'></i>"
        ]

        let width = window.innerWidth 
            let height = window.innerHeight
            let qtdeItens = (height*width)/4096
            let data = ""
            let randomNumber = 0

            /* var widthBody = $("body").css("width")
            var heightBody = $("body").css("height")

            $(".background-icons").css({
                "width": widthBody,
                "height": heightBody 
            }) */
            redefinirTamanhoBackground()
            /* console.log("widthBody=",widthBody, "heightBody", heightBody) */
            $(".background-icons").html(data)
            for (var i = 0; i < qtdeItens; i++) {
                data += icons[ Math.floor(Math.random()*(icons.length - 0) + 0)]
            }
        
            $(".background-icons").html(data)
    })
    </script>
</html>