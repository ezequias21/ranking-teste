function get_page_ajax(url_pagina, container){
 
    $.ajax
        ({
            dataType: "html",
            url: url_pagina, //link da pagina que o ajax buscará
            success: function(data)
            {
               
                $(container).html(data) //Inserindo o retorno da pagina ajax
               

               },
               error: function(data){
                   console.log("Erro Ajax")
               }
           })
           
   }/*
function get_page_ajax_no_script(url_pagina, url_script, container){
 
    $.ajax
        ({
            dataType: 'html',
            url: url_pagina, //link da pagina que o ajax buscará
            success: function(data){
               
             },
               error: function(data){
                   console.log("Erro Ajax")
               }
           })
           
   } */