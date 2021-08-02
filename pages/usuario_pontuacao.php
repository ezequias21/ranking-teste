<?php

require "../config.php";
$id_usuario = 0;
$id_nickname = "";
$icon = "";

if (isset($_GET["id_usuario"])) {
    $id_usuario = $_GET["id_usuario"];
    $sql = "SELECT id, nickname, icon FROM usuario
        WHERE id = $id_usuario";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $obj = $result->fetch_object();
        $id_usuario = $obj->id;
        $id_nickname = $obj->nickname;
        $icon = $obj->icon;
    }
}

?>


<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/mini-card.css">
    <link rel="stylesheet" href="../css/paginator2.css">
    <link rel="stylesheet" href="../css/table-usuario-pontos.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/97577a5cf9.js" crossorigin="anonymous"></script>
    <script src="../js/ajax.js"></script>
    <script src="../js/modal.js"></script>
    <script src="../js/paginator.js"></script>
   
</head>

<body>
    <div class="bar-header" style="box-shadow: 13px 8px 15px -12px rgba(0, 0, 0, 0.36);">
        <a href="../pages/usuario.php" style="text-align: center;" class="buttton-ranking">Voltar </a>
    </div>
    <!--Background de ícones-->
    <div class="background-icons" style="overflow: hidden">
    </div>
    <main>

        <div class="container col-lg-8" style="margin-top: 150px;margin-bottom: 150px">

            <div class="container-partidas">
                <div id_usuario=<?php echo $id_usuario; ?> class="card-usuario" onclick="abrirModal('.containter-atualizar-usuario')">
                    <div class="card-inner">
                        <div class="card-usuario-front">
                            <div class="card-usario-image">
                                <img src="../<?php echo $icon; ?> ">
                            </div>
                            <div class="card-content">
                                <p style="margin-bottom: 0"><?php echo $id_nickname; ?> </p>
                            </div>
                        </div>
                    </div>
                </div>


                <nav class="nav-sub-menu">
                    <ul class="d-flex">
                        <li><span onclick="abrirModal('.containter-atualizar-usuario')">atualizar</span></li>
                        <li><span onclick="abrirModal('.containter-excluir-usuario')">exluir</span></li>
                        <li><span table-link="table-estatisticas.php">ranking</span></li>
                        <li><span class="active" table-link="table-partidas.php">partidas</span></li>
                    </ul>
                </nav>


                <div class="container-table">


                </div>


            </div>
        </div>
    </main>
    <!--Fim do background de ícones-->

    <!--Modal atualizar usuário-->
    <div class="containter-atualizar-usuario" style="display: none;">



        <form id="form-atualiazar-usuario" class="box-shadow animate col-lg-4 col-md-6 col-sm-8  p-4">

            <h3 class="align-center" style="-webkit-text-stroke-width: 2px; letter-spacing: 2px; color: #4d4d4d; text-align: center; padding: 10px;">Editar perfil</h3>

            <div class="container-img-camera d-flex align-items-center justify-content-center">
                <input id="id_usuario_atualizar" value=" <?php echo $id_usuario; ?>" name="id_usuario_atualizar" type="hidden">
                <span onclick="ativarInputFile()">

                    <img src="../<?php echo $icon; ?>" alt="avatar">
                    <i class="fas fa-camera icon-camera"></i>
                </span>


            </div>



            <div class="form-group">
                <label for="exampleInputEmail1">Nickname</label>
                <div id="container-input-nickname" nome-usuario-valido=true>
                    <input id="nome-usuario" class="form-control" type="text" name="nome-usuario" placeholder="Digite um novo nickname" value="<?php echo $id_nickname; ?>" onkeyup="verficarSeUsuarioJaExiste(this)">
                </div>
                <small id="nome-database"></small>
            </div>


            <label>
                <h4 style="color: #4d4d4d;">Selecione um ícone</h4>
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




            <input type="hidden" name="icon" value="<?php echo $_GET["icon"]; ?>">

            <div class="form-group">
                <label for="exampleFormControlFile1">Ou adicione um novo ícone</label>
                <input type="file" class="form-control-file" id="file-upload" name="file">
            </div>


            <p id="message-usuario"></p>
            <input class="form-submit" type="submit" name="submit-criar-usuario" value="Atualizar">
            <span class="fechar" title="Close Modal" onclick=" fecharModal(this)">&times;</span>
        </form>

    </div>



    <!---->
    <!--Fim do modal atualizar usuário-->


    <!--Modal excluir usuário-->
    <div class="container-modal containter-excluir-usuario" style="display: none;">

        <div class="excluir-usuario animate" style="position: relative">
            <h5 class="modal-title">Deseja realmente excluir esse usuário?</h5>
            <hr>
            <div class="pt-5">
                <form style="display: inline-block" action="../pages/usuario.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_usuario_excluir" value="<?php echo $id_usuario; ?>">
                    <button id="excluir-sim" onclick="excluirUsuario()" class="btn-excluir">Sim</button>

                </form>
                <button id="excluir-nao" onclick="ativarFecharModal()" class="btn-excluir">Não</button>
            </div>
            <span class="fechar" title="Close Modal" style="top: 6px" onclick=" fecharModalNoReload(this)">&times;</span>
        </div>



    </div>



    <!---->
    <!--Fim do modal atualizar usuário-->




</body>
<script>
    $("document").ready(function() {
        function redefinirTamanhoBackground() {
            var widthBody = $("body").css("width")
            var heightBody = $(".container").height()
            var marginbottom = $(".container").css("margin-bottom").split(``).filter(n => Number(n) || n == false).join(``)
            var height = parseInt(heightBody) + parseInt(marginbottom);
            height < $(window).height() - 56 ? height = $(window).height() - 56 : height
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

        redefinirTamanhoBackground()
        $(".background-icons").html(data)
        for (var i = 0; i < qtdeItens; i++) {
            data += icons[Math.floor(Math.random() * (icons.length - 0) + 0)]
        }

        $(".background-icons").html(data)

        //get_page_ajax("table-partidas.php",".container-table")

        $.ajax({
            dataType: "html",
            url: "table-partidas.php", //link da pagina que o ajax buscará
            success: function(data) {

                $(".container-table").html(data) //Inserindo o retorno da pagina ajax


            },
            error: function(data) {
                console.log("Erro Ajax")
            }
        })

        $("[table-link]").click(function() {
            let link = $(this).attr("table-link")

            $("[table-link]").each(function(index, element) {
                $(element).removeClass("active")
            })
            $(this).addClass("active")
            // get_page_ajax(link, ".container-table")

            $.ajax({
                dataType: "html",
                url: link, //link da pagina que o ajax buscará
                success: function(data) {

                    $(".container-table").html(data) //Inserindo o retorno da pagina ajax


                },
                error: function(data) {
                    console.log("Erro Ajax")
                }
            })
        })



        /**Preview  da imagem*/





    })

    function getIdUsuario() {
        return parseInt($(".card-usuario").attr("id_usuario"))
    }

    function ativarInputFile() {
        $("#file-upload").click()
    }

    function ativarFecharModal() {
        fecharModalNoReload($("#excluir-nao").parent().next()[0])
    }

    function excluirUsuario() {
        //window.location.href = "../pages/usuario.php?excluir_id_usuario=id";
    }

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

    $(".icon").click(function() {

    })


    $("#form-atualiazar-usuario .icon").click(function() {


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



    $("#form-atualiazar-usuario").submit(function(event) {
        event.preventDefault()


        var serializeDados = $(this).serializeArray();
        let form = new FormData(this)
        var files = $('#file-upload')[0].files[0]
        form.append('file', files)

        /* 
         files || $("input[name=icon]").val() || $("#message-usuario").html("<div class='alert alert-warning' role='alert'>Selecione algum ícone!</div>") 
         var resultado = ( files || $("input[name=icon]").val() ) && $("#nome-usuario").parent().attr("nome-usuario-valido") 
         console.log("Resultado", typeof(resultado)) */
        if ($("#nome-usuario").parent().attr("nome-usuario-valido") == "true")

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
                    console.log("Sucess=", data)
                    $("#message-usuario").html(data)
                },
                error: function(xhr, er) {
                    console.log("error")
                }
            });
    })
</script>

</html>