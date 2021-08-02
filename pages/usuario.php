<?php
require "../config.php";
    if(isset($_POST["id_usuario_excluir"])){
        $id_usuario_excluir = $_POST["id_usuario_excluir"];
        $sql = "UPDATE usuario
        SET ativo = 1
        WHERE id = $id_usuario_excluir";
    $result = $conn->query($sql);
    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
        <link rel="stylesheet" href="../css/modal.css">

        <script src="https://kit.fontawesome.com/97577a5cf9.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="../js/modal.js"></script>
        <style>
            body {
                background-color: rgb(205, 27, 34);
            }

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
                color: white;
                font-size: 2.8rem;
                /*  z-index: -5; */
                opacity: 0.08;
            }

            i:hover {
                opacity: 1;
            }

            /*Fim dos estilos do background*/
            .card-usuario {

                background-color: transparent;
                width: 10rem;
                height: 11rem;
                perspective: 1000px;
                margin: 10px;

            }

            .card-inner {

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
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);

            }

            .card-inner:hover {
                background-color: #666;
            }

            .card-usuario-front {
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

            .card-usario-image {
                width: 5rem;
                height: 5rem;

            }

            .card-usario-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 50%;
                border: 1px solid #ddd;
            }

            .card-content {

                padding: 13px 23px;
                border-radius: 30px;
                color: white;
                font-size: 1.3rem;

            }

            .text-title {
                color: black;
                background-color: transparent;
                margin: 10px;
                padding: 10px;
                border-radius: 5px;
                color: white;
                -webkit-text-stroke-width: 2px;
                font-size: 3.5em;
            }

            .card-usuario-back p {
                color: white;
                font-size: 1.4rem;
                -webkit-text-stroke-width: 1px;
            }

            /* ul{
    padding: 0;
    margin: 0;
    list-style-type: none;
    height: 65px;
}
li{
    display: inline;
    font-size: 1.1rem;
    padding: 10px 20px;
    
} */

            /*Estilos da navegação */
            .navbar-light .navbar-nav .nav-link {
                /* color: rgba(0,0,0,.5); */
                color: #666666;
                -webkit-text-stroke-width: 0;
                color: #666666;
                letter-spacing: 0.4;
                font-size: 1.1em;

            }

            .navbar-light .navbar-brand {
                color: rgba(0, 0, 0, .6);
                font-weight: 600;
                font-size: 1.3rem;
            }

            a {
                cursor: pointer;
            }

            /*Fim dos estilos da navegação */
        </style>



    </head>

<body>
    <header>
        <!-- <div class="bar-header" style="background-color: white;box-shadow: 13px 8px 15px -12px rgba(0, 0, 0, 0.36);"> -->
        <!-- <nav class="navigation" style="background-color: white;box-shadow: 13px 8px 15px -12px rgba(0, 0, 0, 0.36);">        
    <ul class="d-flex align-items-center">
        <li>
            <a href="../index.php" >Cadastrar</a>
        </li>    

        <li class="ml-auto">
            <a href="../index.php">
                <span class="d-flex align-items-center">
                    <span style="display: inline-block"><i  class="fa fa-long-arrow-left" aria-hidden="true" style="color: black; font-size: 1.4em; padding: 5px; opacity: 0.8"></i></span>
                    <span style="display: inline-block">Voltar</span>
                </span>
            </a>

        </li>
    </ul>
        
</nav> -->
        <!---->

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: white;  box-shadow: 13px 8px 15px -12px rgba(0, 0, 0, 0.36);">
            <a class="navbar-brand" href="../index.php">Re9 Games<i class='fas fa-dice' style="color: #666; font-size: 1.4em; padding: 5px; opacity: 0.8"></i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a id="get-form-cadastro" class="nav-link" onclick="abrirModal('.containter-criar-usuario')">Cadastrar Usuário</a>
                    </li>
                </ul>


                <form class="form-inline my-2 my-lg-0">
                    <a class="nav-link" href="../index.php" style="color: #4d4d4d; padding: 10px; font-size: 1.1rem;">voltar</a>
                </form>


            </div>
        </nav>




    </header>
    <!--Background de ícones-->
    <div class="background-icons" style="overflow: hidden">
    </div>
    <!--Fim do background de ícones-->
    <main>

        <div class="container col-lg-8 mb-5">
            <h1 class="text-title" style="text-align: center;">Players</h1>

            <div class="d-flex flex-wrap justify-content-center align-items-center">
                <?php

                require "../config.php";
                $sql = "SELECT id, nickname, icon FROM usuario WHERE ativo = 0";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($obj = $result->fetch_object()) {

                        echo "<a href='usuario_pontuacao.php?id_usuario=" . $obj->id . "&nickname=" . $obj->nickname . "&icon=" . $obj->icon . "'><div id_usuario='" . $obj->id . "' class='card-usuario'>
                            <div class='card-inner'>
                                <div class='card-usuario-front'>
                                    <div class='card-usario-image'>
                                        <img src='../" . $obj->icon . "'>
                                    </div>
                                <div class='card-content'>
                                    <p style='margin-bottom: 0'>" . $obj->nickname . "</p>
                                </div> 
                            </div>

                            </div>   
                            </div></a>";
                    }
                }
                ?>



            </div>

        </div>


        <!--Modal cadastrar usuário-->
        <div class="containter-criar-usuario">
            <form id="form-criar-usuario" class="box-shadow animate col-lg-4 col-md-6 col-sm-8  p-4">


                <h3 style="-webkit-text-stroke-width: 2px; letter-spacing: 2px; color: #4d4d4d; text-align: center; padding: 10px;">Crie um usuário</h3>


                <div class="container-img-camera d-flex align-items-center justify-content-center">
                    <span onclick="ativarInputFile()">

                        <img src="../imgs/icons/user.png" alt="avatar">
                        <i class="fas fa-camera icon-camera"></i>
                    </span>


                </div>

                <input type="hidden" name="usuario-cadastrar" value="0">
                <div class="form-group">
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
                        <img class="icon" src="../imgs/icons/icon1.jpg" icon="imgs/icons/icon1.jpg" alt="Icon">
                        <img class="icon" src="../imgs/icons/icon2.jpg" icon="imgs/icons/icon2.jpg" alt="icon">
                        <img class="icon" src="../imgs/icons/icon3.jpg" icon="imgs/icons/icon3.jpg" alt="icon">
                        <img class="icon" src="../imgs/icons/coelho.jpg" icon="imgs/icons/coelho.jpg" alt="icon">
                        <img class="icon" src="../imgs/icons/gamba.jpg" icon="imgs/icons/gamba.jpg" alt="Icon">
                        <img class="icon" src="../imgs/icons/macaco.jpg" icon="imgs/icons/macaco.jpg" alt="icon">
                        <img class="icon" src="../imgs/icons/rato.png" icon="imgs/icons/rato.png" alt="icon">
                        <img class="icon" src="../imgs/icons/papagaio.jpg" icon="imgs/icons/papagaio.jpg" alt="icon">
                        <img class="icon" src="../imgs/icons/vaca.jpg" icon="imgs/icons/vaca.jpg" alt="icon">
                        <img class="icon" src="../imgs/icons/peixe.jpg" icon="imgs/icons/peixe.jpg" alt="icon">
                    </div>


                </div>




                <input type="hidden" name="icon" value="">

                <div class="form-group">
                    <label for="exampleFormControlFile1">Ou adicione um novo ícone</label>
                    <input type="file" class="form-control-file" id="file-upload" name="file">
                </div>


                <p id="message-usuario"></p>
                <input class="form-submit" type="submit" name="submit-criar-usuario" value="Criar">
                <span class="fechar" title="Close Modal" onclick="fecharModal(this)">&times;</span>
            </form>

        </div>
        <!--Fim do modal cadastrar usuário-->


    </main>


</body>

</html>
<script>
    function ativarInputFile() {
        $("#file-upload").click()
    }
    $("document").ready(function() {
        function redefinirTamanhoBackground() {
            var widthBody = $("body").css("width")
            var heightBody = $(".container").height()
            var marginbottom = $(".container").css("margin-bottom").split(``).filter(n => Number(n) || n == false).join(``)
            var height = parseInt(heightBody) + parseInt(marginbottom);
            height < $(window).height() - 56 ? height = $(window).height() - 65 : height
            $(".background-icons").css({
                "width": widthBody,
                "height": height + "px"
            })
            console.log("widthBody=", widthBody, "heightBody", heightBody, "margin-bottom= ", marginbottom, "height=", height)
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
        let qtdeItens = (height * width) / 4096
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
            data += icons[Math.floor(Math.random() * (icons.length - 0) + 0)]
        }

        $(".background-icons").html(data)


        $("#form-criar-usuario .icon").click(function() {


            $("#form-criar-usuario .icon").each(function(index, element) {
                $(element).removeClass("icon-selecionado")
            })

            $(this).addClass("icon-selecionado")

            /*O endereço do ícone selecionado é colocado no atributo hidden do html para ser recuperado depois 
            quando o usuário for cadastrado/atualizado.*/
            var attrIcon = $(this).attr("icon")
            var srcIcon = $(this).attr("src")
            $("input[name=icon]").val(attrIcon).change()
            var img = document.querySelector(".container-img-camera img")
            img.src = srcIcon

            //console.log("srcIcon = ", srcIcon)
        })

        pesquisarNickname()
        $("#file-upload").change(function() {

            var file = $("#file-upload")[0].files[0]
            var img = document.querySelector(".container-img-camera img")
            if (file) {

                const reader = new FileReader();
                reader.onload = function() {
                    const result = reader.result;
                    img.src = result;
                }
                reader.readAsDataURL(file);
            }
        })

        $("#form-criar-usuario").submit(function(event) {
            event.preventDefault()


            var serializeDados = $(this).serializeArray();
            let form = new FormData(this)
            var files = $('#file-upload')[0].files[0]
            form.append('file', files)


            files || $("input[name=icon]").val() || $("#message-usuario").html("<div class='alert alert-warning' role='alert'>Selecione algum ícone!</div>")
            var resultado = (files || $("input[name=icon]").val()) && $("#nome-usuario").parent().attr("nome-usuario-valido")
            console.log("Resultado", typeof(resultado))
            if (resultado == "true")

                $.ajax({
                    url: '../PHP/cadatrar-jogo.php',
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
                        console.log("Sucess=", data)
                        $("#message-usuario").html(data)
                    },
                    error: function(xhr, er) {
                        console.log("error")
                    }
                });
        })

    })
</script>