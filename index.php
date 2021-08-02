
<?php
   
 
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<!-- <link rel="stylesheet" href="css/criar-usuario2.css"> -->
<!-- <link rel="stylesheet" href="css/home1.css">
<!-- <link rel="stylesheet" href="css/header.css"> -->
<!--  <link rel="stylesheet" href="css/cadastrar-jogo2.css"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/paginaPrincipal.css">
<link rel="stylesheet" href="./css/selecionar-jogador3.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://kit.fontawesome.com/97577a5cf9.js" crossorigin="anonymous"></script>
<script src="js/modal.js" crossorigin="anonymous"></script>

</head>

<body>



<!---->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: white;  box-shadow: 13px 8px 15px -12px rgba(0, 0, 0, 0.36);"> 
  <a class="navbar-brand" href="index.php">Re9 Games<i class='fas fa-dice' style="color: #666; font-size: 1.4em; padding: 5px; opacity: 0.8"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <!-- <a class="nav-link" href="#">Cadastrar jogo <span class="sr-only">(current)</span></a> -->
        <a id="get-form-cadastro" class="nav-link" onclick="abrirModal('.container-cadastrar-jogo')">Cadastrar jogo</a>
      </li>
      <li class="nav-item active">
        <a href="pages/usuario.php" class="nav-link" >Usuário</a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="pages/ranking-total.php">Ranking</a>
      </li>
 
   

  </div>
</nav>

    <!--Background de ícones-->
    <div class="background-icons" style="overflow: hidden">
    </div>
     <!--Fim do background de ícones-->   

    <div class="container container-pagina-ajax col-lg-8 mb-5">
        <h1 class="text-title" style="text-align: center;">Games</h1>
        <div class="d-flex flex-wrap justify-content-center align-items-center">
        
        <?php

        require "config.php";
        $sql = "SELECT id, nome, link_imagem_jogo FROM jogo";
        $result = $conn->query($sql) or die($conn->error);
        
        
        if ($result->num_rows > 0) {
        while($obj = $result->fetch_object()){

            $link_imagem = $obj->link_imagem_jogo;
            if(strlen($link_imagem) == 0){
                $link_imagem = 'imgs/imgs_jogos/imagem_padrao.png';
            }
            echo "  <a class='via-ajax' id_jogo='". $obj->id ."'  href='pages/modo_de_jogo.php'>
            <div class='card m-4' style='width: 18rem;  display: inline-block;'>
                            <div  style='height: 11rem;'>
                                <img class='card-img-top img-height' src='" . $link_imagem. "' alt='". $obj->link_imagem_jogo."'>
                            </div>
                            <div class='card-body'>
                                <p class='card-text text-center'> ". $obj->nome ."</p>
                            </div>
                        </div>
                    </a>";
            }
        
    } else {
        echo "<h4> Nenhum jogo cadastrado</h4>"; 
    }
    ?>

            
    </div>
    </div>

<!--Modal cadastrar jogo-->
<div class="container-cadastrar-jogo">
        <form id="cadastrar-jogo" class="box-shadow animate col-lg-5 col-sm-8 p-4" action="PHP/cadatrar-jogo.php" method="post"
            enctype="multipart/form-data">
            <h3>Cadastre um jogo</h3>

            <div class="form-group">
                <label for="exampleInputEmail1">Nome</label>
                <input type="text" name="nome-jogo" class="form-control" placeholder="Digite o nome do jogo">
            </div>

      
                <div class="row">
                    <label class="col">Escolha a quantidade máxima de jogadores</label>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <input type="hidden" name="qtde-jogadores" value="2">
                        <span class="btn-qtde-jogadores" value="2" >2</span>
                        <span class="btn-qtde-jogadores" value="3" >3</span>
                        <span class="btn-qtde-jogadores" value="4" >4</span>
                    </div>
                </div>
            

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Informe os possíveis times</label><br>
                    <select class="multi_select" name="modos-de-jogo[]" multiple>
                        <option>1 x 1</option>
                        <option>1 x 1 x 1</option>
                        <option>1 x 1 x 1 x 1</option>
                        <option>2 x 2</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Aceita empate?</label>
                    <select id="inputState" name="aceita-empate" class="form-control">
                        <option selected value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputZip">Disponível</label>
                    <select id="inputState" name="disponivel" class="form-control">
                        <option selected value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label for="exampleFormControlFile1">Selecione uma imagem para o jogo</label>
                <input type="file" id="file" name="file" class="form-control-file" id="exampleFormControlFile1">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Descrição</label>
                <textarea class="form-control" name="descricao" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div id="cadastrar-jogo-messages"></div>
            <input type="submit" name="submit-cadastrar-jogo" value="Cadastar">

            <span class="fechar" title="Close Modal" onclick="fecharModal(this)">&times;</span>
        </form>
    </div>
<!--Fim do modal cadastrar jogo-->



<!--Início do modal cadastrar usuário--> 
<div class="containter-criar-usuario" >
                    <form id="form-criar-usuario" class="box-shadow animate col-lg-4 col-md-6 col-sm-8  p-4">

                        <label>
                            <h3>Nickname</h3>
                        </label>

                       
                        <input type="hidden" name="usuario-cadastrar" value="0" >
                        <div  class="form-group">
                            <label for="exampleInputEmail1">Nickname</label>
                           <div id="container-input-nickname" nome-usuario-valido=false>
                                <input id="nome-usuario" class="form-control" type="text" name="nome-usuario" placeholder="Digite um novo nickname">
                           </div>
                            <small id="nome-database"></small>
                        </div>


                        <label>
                            <h4>Selecione um ícone</h4>
                        </label>

                        <div class="form-row">
                            <div class="col d-flex flex-wrap justify-content-center align-items-center">
                                <img class="icon" src="imgs/icons/icon1.jpg" alt="Icon"> 
                                <img class="icon" src="imgs/icons/icon2.jpg" alt="icon">
                                <img class="icon" src="imgs/icons/icon3.jpg" alt="icon">
                                <img class="icon" src="imgs/icons/coelho.jpg" alt="icon">
                                <img class="icon" src="imgs/icons/gamba.jpg" alt="Icon">
                                <img class="icon" src="imgs/icons/macaco.jpg" alt="icon">
                                <img class="icon" src="imgs/icons/rato.png" alt="icon">   
                                <img class="icon" src="imgs/icons/papagaio.jpg" alt="icon">    
                                <img class="icon" src="imgs/icons/vaca.jpg" alt="icon">   
                                <img class="icon" src="imgs/icons/peixe.jpg" alt="icon">    
                            </div>
                       
                       
                        </div>


                        
                       
                        <input type="hidden" name="icon" value="">

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Ou adicione um novo ícone</label>
                            <input type="file" class="form-control-file" id="file-upload"  name="file">
                        </div>


                        <p id="message-usuario"></p>
                        <input class="form-submit" type="submit" name="submit-criar-usuario" value="Criar">
                        <span class="fechar" title="Close Modal" onclick="fecharModal(this)">&times;</span>
                    </form>
                
            </div>
<!--Fim do modal cadastrar usuário-->  
 <script>

objJogo = {
    id_jogo: -1,
    modo_de_jogo: {},
}
let jogadoresSelecionados = 0
let timesRestantes = 0

let resultado = []
resultado["vitoria"] = 0
resultado["empate"] = 1
resultado["derrota"] = 2
/*A função a seguir desenha os ícones na tela formando um background */

function redefinirTamanhoBackground(){
    var widthBody = $("body").css("width")
    var heightBody = $(".container").height()
    var marginbottom = $(".container").css("margin-bottom").split(``).filter(n => Number(n) || n == false).join(``)
    var height = parseInt(heightBody) + parseInt(marginbottom) ;
   // console.log("Height-body = ", heightBody, "Margin-bottom = ", marginbottom)
    height < $(window).height() - 65 ?  height = $(window).height() - 65 : height
    $(".background-icons").css({
        "width": widthBody,
        "height": height + "px"
    })
    console.log("widthBody=",widthBody, "heightBody = ", heightBody, "margin-bottom= ", marginbottom, "height=",height)
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

            redefinirTamanhoBackground()
            //console.log("widthBody=",widthBody, "heightBody", heightBody)
            $(".background-icons").html(data)
            for (var i = 0; i < qtdeItens; i++) {
                data += icons[ Math.floor(Math.random()*(icons.length - 0) + 0)]
            }
        
            $(".background-icons").html(data)




function get_page_ajax(url_pagina, url_script, container){
 
 $.ajax
     ({
         dataType: 'html',
         url: url_pagina, //link da pagina que o ajax buscará
         success: function(data)
         {
            
             $(container).html(data); //Inserindo o retorno da pagina ajax
             $.getScript(url_script,function(data, textStatus, jqxhr ){
                    console.log("Status=",textStatus)
             })
            },
            error: function(data){
                console.log("Erro Ajax")
            }
        }); 
        
}
$('document').ready(function(){
   


   $('#cadastrar-jogo').submit(function(event){
        event.preventDefault();
       

        var serializeDados = $(this).serializeArray();
        let form =  new FormData(this)
        var files = $('#file')[0].files[0]
        form.append('file', files)
        $.ajax({
                 url: 'PHP/cadatrar-jogo.php',
                 type: 'POST',
                 data: form,
                 enctype: 'multipart/form-data',
                 contentType: false,
                 processData: false,
                 beforeSend: function() {
                     console.log("beforeSend")
                 },
                 complete: function() {

                     console.log("complete")
                 },
                 success: function(data) {
                    console.log("succes")
                    console.log("Resposta Cadastro=",data)
                    $("#cadastrar-jogo-messages").html(data)
                 /*    document.location.reload(true); */
            
                 },
                 error: function(xhr,er) {
                     console.log("error")
                 }
             }); 
        }) 

        $('.multi_select').selectpicker();

        $(".btn-qtde-jogadores").click(function(){
            
            
            var qtde_jogadores = $(this).attr("value")
            $(".btn-qtde-jogadores").each(function(index, element){
                $(element).removeClass("btn-qtde-jogadores-selecionado")
            })

            $(this).addClass("btn-qtde-jogadores-selecionado")
            console.log("qtde_jogadores=", qtde_jogadores)
            $("[name=qtde-jogadores]").val(qtde_jogadores).change()
            
        })

        
        $(".via-ajax").click(function(e){
       
            e.preventDefault();
            console.log('Via ajax')
            var link = $(this).attr('href');
            objJogo.id_jogo = $(this).attr('id_jogo');
            $.ajax
            ({
                dataType: 'html',
                url: link, //link da pagina que o ajax buscará
                success: function(data)
                {
                    $(".container-pagina-ajax").html(data); //Inserindo o retorno da pagina ajax
                },
                error: function(data){
                    console.log("Erro Ajax")
                }
            }); 
         
        });


        
       
      
      
        /**Fim do modal */
       

        
       

     
})




</script>

</body>
</html>