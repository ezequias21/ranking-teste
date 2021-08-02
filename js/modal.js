
function abrirModal(nomeModal){
    $(nomeModal).css('display','block')
}

function fecharModal(event){
    console.log("Fechando")
    $(event).parent().parent().css('display', 'none')
    window.location.reload()
   
}
function fecharModalNoReload(event){
    console.log("Fechando")
    $(event).parent().parent().css('display', 'none')
   
}
function fecharModalNoReload(event){
    $(event).parent().parent().css('display', 'none')
   
}

function verficarSeUsuarioJaExiste(element){



    let searchNickname = $(element).val()
    console.log(element)
    console.log(searchNickname)
    if(searchNickname == ""){
        console.log("NicknameVazio")
        $("#nome-usuario").parent().attr("nome-usuario-valido",false)
        $("#nome-database").html("O nome de usuario não pode ser vazio.").css("color","red")
    }
  /*   searchNickname || $("#nome-usuario").attr("nome-usuario-valido",true)
    searchNickname || $("#nome-usuario").attr("nome-usuario-valido",false) */
    else{

        $("#message-usuario").html("") 
        $.ajax({
            url: "../PHP/cadatrar-jogo.php",
            method: "post",
            data: {
                searchNickname: searchNickname,
            },
            success: function(data) {
                $("#nome-database").html(data)
                if(data=="Ok") {
                    $("#nome-usuario").parent().attr("nome-usuario-valido",true)
                    $("#nome-database").css("color", "green")
                }
                else{ 
                    $("#nome-usuario").parent().attr("nome-usuario-valido",false)
                    $("#nome-database").css("color", "red")
                }
                
            },      
        })
    }

}

function pesquisarNickname(){
    
    $("#nome-usuario").keyup(function() {

        let searchNickname = $(this).val()
        console.log(searchNickname)
        if (searchNickname == "") {
            console.log("NicknameVazio")
            $("#nome-usuario").parent().attr("nome-usuario-valido", false)
            $("#nome-database").html("O nome de usuario não pode ser vazio.").css("color", "red")
        }
        /*   searchNickname || $("#nome-usuario").attr("nome-usuario-valido",true)
          searchNickname || $("#nome-usuario").attr("nome-usuario-valido",false) */
        else {

            $("#message-usuario").html("")
            $.ajax({
                url: "../PHP/cadatrar-jogo.php",
                method: "post",
                data: {
                    searchNickname: searchNickname,
                },
                success: function(data) {
                    $("#nome-database").html(data)
                    if (data == "Ok") {
                        $("#nome-usuario").parent().attr("nome-usuario-valido", true)
                        $("#nome-database").css("color", "green")
                    } else {
                        $("#nome-usuario").parent().attr("nome-usuario-valido", false)
                        $("#nome-database").css("color", "red")
                    }

                },
            })
        }
    })
}