<?php
$id_jogo = "";
if(isset($_GET["id_jogo"])){
  $id_jogo = $_GET["id_jogo"];
}
?>


<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
<link rel="stylesheet" href="../css/home.css">
<link rel="stylesheet" href="../css/ranking1.css">
<link rel="stylesheet" href="../css/paginator2.css">


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://kit.fontawesome.com/97577a5cf9.js" crossorigin="anonymous"></script>
<script src="../js/paginator.js"></script>
<!--   <link rel="stylesheet" href="../css/ranking-total.css">-->


</head>
<style>
      .mini-card {
    position: relative;
    width: 4.5rem;
    cursor: pointer;
    filter: grayscale(1);
    opacity: 0.5;
    margin: 10px 60px 20px 10px;
    transition: ease 0.4s;
    
}
.active{
  filter: grayscale(0);
  opacity: 1;
}
.mini-card:hover{
  filter: grayscale(0);
  opacity: 1;
}
.mini-card-icone {
    width: 4.5rem;
    height: 6rem;
    border: 2px solid white;
    border-radius: 5px;
}
.mini-card-icone img {
    vertical-align: middle;
    border-style: none;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.mini-card .title {
    position: absolute;
    bottom: 8px;
    left: 75px;
    background-color: white;
    margin: 0;
    padding: 7px;
    border-radius: 0 50px 50px 0;
    background-color: #ddd;
    z-index: -3;
}
.mini-card::after{
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 5px; 
    background-color: #537895;
    transform: rotate(-5deg);
    z-index: -1;
}
.mini-card::before{
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 5px;
    background-color: #592c1d; 
    z-index: -2;
    transform: rotate(-14deg);
}
/**Estilos para a opção de ranking */

.container-opcao-de-ranking {
    padding: 10px;
    margin-bottom: 4px;
    border-radius: 5px;
    box-shadow: 4px 3px 14px 3px rgb(0 0 0 / 28%);
    background-color: white;
    z-index: -2;
}

.icon-opcao-de-ranking i{
 /*  display: inline-block; */
 font-size: 1.1rem;
    padding: 3px;
    opacity: 1;
    margin: 0;
}
.opcao-de-ranking {
  padding: 5px 20px;
    /* border: 1px solid #666; */
    /* border-radius: 50px; */
    cursor: pointer;
    /* margin: 3px 4px; */
    display: inline-block;
   /*  margin: 3px 4px; */
}
.active-opcao-ranking{
  background-color: #ddd;
}
/**Fim dos estilos da opção de  de ranking */


@media screen and (max-width: 767px) {
  .container-opcao-de-ranking {
    margin: 10px;
    display: flex;
    justify-content: center;
}

}

</style>

<body>
  
  <div class="bar-header" style="box-shadow: 13px 8px 15px -12px rgba(0, 0, 0, 0.36);">
    <a href="../index.php"style="text-align: center;" class="buttton-ranking">Voltar </a>
</div>


  <!--Background de ícones-->
  <div class="background-icons" style="overflow: hidden">
  </div>
  <!--Fim do background de ícones-->



  <div class="container col-lg-8">

  <!-- <div class="row mt-4">
    <h2 class="title-raking col-md-8 col-sm-3 align-middle">Ranking <span id="tabela-subtitle"></span></h2>
    
    <div class="col-sm d-flex align-items-center">

      <select id="selecionar-ranking"  class="form-control">
        <option value="0">Selecione um jogo</option>
      </select>
    </div>

  </div> -->
  <h2 class="title-raking" style="text-align:center">Ranking <span id="tabela-subtitle"></span></h2>
  <div class="d-flex flex-wrap justify-content-center m-3">

  <?php
      require "../config.php";
      $sql = "SELECT id, nome, link_imagem_jogo FROM jogo";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
        while($obj = $result->fetch_object()){
          echo "<div id_jogo='" . $obj->id ."' nome_jogo = '" . $obj->nome ."'  class='mini-card'>
                  <div class='mini-card-icone'>
                      <img src='../" . $obj->link_imagem_jogo ."'>
                  </div>
                      <div class='title'>" .$obj->nome . "</div>
                </div>";
        }
      }
    
    ?>



   <!--  <div class="mini-card">
      <div class="mini-card-icone">
          <img src="../imgs/dama.jpeg">
      </div>
          <div class="title">Dama</div>
    </div>



        <div class="mini-card">
          <div class="mini-card-icone">
            <img src="../imgs/ludo.png">
          </div>
          <div class="title">Ludo</div>
        </div>

        <div class="mini-card active">
          <div class="mini-card-icone">
            <img src="../imgs/sinuca.jpg">
          </div>
          <div class="title">Sinuca</div>
        </div> -->


      </div>

<div class="mt-4">


  <div class="container-opcao-de-ranking">
    
    <input type="hidden" name="gerar_tabela" id_jogo='<?php echo $id_jogo?>'>
    <div tipo_ranking="0" class="opcao-de-ranking">
      <span>Ranking individual</span>
      <span class="icon-opcao-de-ranking">
        <i class="fas fa-user"></i>
      </span>
    </div>
    <div tipo_ranking="1" class="opcao-de-ranking active-opcao-ranking">
      <span>Ranking em grupo</span>
      <span class="icon-opcao-de-ranking">
        <i class="fas fa-users"></i>
      </span>
    </div>
  </div>
      <table class="table table-striped custom-pagination">
      <thead>
        <tr>
          <th class="align-middle" scope="col"></th>
          <th class="align-middle" scope="col">Jogador</th>
          <th class="align-middle" scope="col">Pontuação</th>
          <th class="align-middle" scope="col">Partidas</th>
          <th class="align-middle" scope="col">Vitória</th>
          <th class="align-middle" scope="col">Empates</th>
          <th class="align-middle" scope="col">Derrotas</th>
         
        </tr>
      </thead>
      <tbody>
        <tr><td class="col-span" colspan=7>Selecione um jogo para visualizar o ranking.</td></tr>
      </tbody>
    </table>
    </div>

<!--     <div class="pagination d-flex justify-content-center">
      <ul class="pagination-controls">
        <li class="btn-prev"><span><i class="fas fa-angle-left"></i> Anterior</span></li>
        <li class="number active-btn-pagination"><span>1</span></li>
        <li class="number"><span>2</span></li>
        <li class="dots"><span>...</span></li>
        <li class="number"><span>4</span></li>
        <li class="number"><span>5</span></li>
        <li class="btn-next"><span>Próximo <i class="fas fa-angle-right"></i></span></li>
      </ul>

    </div> -->

    <div class="pagination d-flex justify-content-center">
        <ul class="pagination-controls">
        <li class="btn-prev"><i class="fas fa-angle-left icon-right" aria-hidden="true"></i><span>Anterior</span></li>
      <li class="btn-next"><span>Próximo</span><i class="fas fa-angle-right icon-next" aria-hidden="true"></i></li>
        </ul>
    </div>

  </div>
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



      













  function organizarTrofeuTabela(){
    
    console.log($("img"))
    imgs = [
      "../imgs/medal-ouro.png",
      "../imgs/medal-prata.png",
      "../imgs/medal-bronze.png"
    ]
    let linhasDaTabela = $("img")
    $(".trofeu").each(function(index, element){
      if(index <= 2){
        element.src= imgs[index]
      }else{
        $(element).parent().add( "p" ).html(" <span class='ranking-position-label'> " + (index+1) + "° </span>" )
        console.log($(element).parent()[0])
      }
    
    })
  }
  
  organizarTrofeuTabela()

          /*  
  $.ajax({
            url: "../PHP/gerar-ranking.php",
            method: "get",
            data: {
                'jogo': 0
            },
            success: function(data) {
             // console.log("Sucesso=", data)
              $("#selecionar-ranking").html(data)
              paginar()
            },
            done: function(){
              paginar()
            }      
          }) 
         
       */
$("#selecionar-ranking").change(function(){
    let id_jogo = $(this).val()

    if(id_jogo!="0"){

      $.ajax({
            url: "../PHP/gerar-ranking.php",
            method: "get",
            data: {
                'id_jogo': id_jogo
            },
            success: function(data) {
              console.log("Sucesso=", data)
              $(".table tbody").html(data)
              organizarTrofeuTabela()

              var jogoAtualNome = $("#selecionar-ranking").find(":selected").text();
              $("#tabela-subtitle").html(jogoAtualNome)
             },      
          }) 
    }else{
      $("#tabela-subtitle").html("")
      $("tbody").html(" <tr><td class='col-span' colspan=7>Selecione um jogo para visualizar o ranking.</td></tr>")
    }


})

function gerarTabela(data, container =null){
  console.log("Data = ", data)
  $.ajax({
            url: "../PHP/gerar-ranking.php",
            method: "get",
            data: data,
            success: function(data) {

              $(".table tbody").html(data)
              organizarTrofeuTabela()
              console.log("TableLenght ", $(".custom-pagination tbody tr").length) //tabela ranking individual
              startPaginator()
             },      
    }) 
}

$(".mini-card").click(function(){
    $(".mini-card").each(function(index, element){
        $(element).removeClass("active")
    })
    let elementoAtual = $(this)
    elementoAtual.addClass("active")
    var id_jogo = elementoAtual.attr("id_jogo")
    console.log("Id_jogo= ", id_jogo)
    let tipo_ranking = 1

    $(".opcao-de-ranking").each(function(index, element){

      if($(element).hasClass("active-opcao-ranking")){
      
          tipo_ranking = $(element).attr("tipo_ranking")
          console.log( "Ranking clicando ",tipo_ranking)
          return element
      }


      })  

    $.ajax({
            url: "../PHP/gerar-ranking.php",
            method: "get",
            data: {
                'id_jogo': id_jogo,
                'tipo_ranking': tipo_ranking
            },
            success: function(data) {


              //console.log("Sucesso=", data)
              $(".table tbody").html(data)
              organizarTrofeuTabela()
              console.log("TableLenght ", $(".custom-pagination tbody tr").length)
             // startPaginator()
             startPaginator()
              var jogoAtualNome = elementoAtual.attr("nome_jogo")
              console.log("JogoNome atual = ",elementoAtual.attr("nome_jogo"))
              $("#tabela-subtitle").html(jogoAtualNome)
             },      
    }) 
})

$(".opcao-de-ranking").click(function(){

let id_jogo = 0
  $(".mini-card").each(function(index, element){
        if($(element).hasClass("active")){
          id_jogo = $(element).attr("id_jogo")
        }
    })
    let elementoAtual = $(this)
    elementoAtual.addClass("active")


  $(".opcao-de-ranking").each(function(index, element){
      $(element).removeClass("active-opcao-ranking")
  })

  let tipo_ranking = $(this).addClass("active-opcao-ranking").attr("tipo_ranking")
  gerarTabela({ 'id_jogo': id_jogo, 'tipo_ranking': tipo_ranking })
  

})

function firstLoad(){
  var id_jogo  = $("[name=gerar_tabela]").attr("id_jogo")
  if(id_jogo != ""){
    $(`[id_jogo=${id_jogo}]`).addClass("active")
    gerarTabela({ 'id_jogo': id_jogo, 'tipo_ranking': 1 })
  }
  
}
firstLoad()
})


</script>
</html>