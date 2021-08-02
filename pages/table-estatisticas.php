<div class="content d-flex flex-wrap justify-content-center align-items-center mb-4" style="box-shadow: 4px 3px 14px 3px rgba(0,0,0,0.28);">
    <?php
    require "../config.php";
    $sql = "SELECT id, nome, link_imagem_jogo FROM jogo";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($obj = $result->fetch_object()) {
            echo "<div id_jogo='" . $obj->id . "' nome_jogo = '" . $obj->nome . "'  class='mini-card'>
                  <div class='mini-card-icone'>
                      <img src='../" . $obj->link_imagem_jogo . "'>
                  </div>
                      <div class='title'>" . $obj->nome . "</div>
                </div>";
        }
    }

    ?>

</div>
<div class="table-header-title mt-5">Ranking</div>
<table id="ranking" class="table table-striped">
    <thead>

        <tr>
            <th class="align-middle" scope="col">Pontuação</th>
            <th class="align-middle" scope="col">Tipo</th>
            <th class="align-middle" scope="col">Partidas</th>
            <th class="align-middle" scope="col">Vitórias</th>
            <th class="align-middle" scope="col">Empates</th>
            <th class="align-middle" scope="col">Derrotas</th>
            <th class="align-middle" scope="col">Streak</th>
        </tr>

    </thead>
    <tbody>


        <tr>
            <td class='col-span' colspan=7>Escolha um jogo para visualizar o ranking.</td>
        </tr>

    </tbody>
</table>



<div class="table-header-title mt-5">Aliados frequentes</div>
<table id="aliados-frequentes" class="table table-striped custom-pagination">
    <thead>
        <tr>
            <th class="align-middle" scope="col">Player</th>
            <th class="align-middle" scope="col">Partidas</th>
            <th class="align-middle" scope="col">Vitórias</th>
            <th class="align-middle" scope="col">Empates</th>
            <th class="align-middle" scope="col">Derrotas</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td class='col-span' colspan=7>Escolha um jogo para visualizar o ranking.</td>
        </tr>


    </tbody>
</table>

<div class="pagination d-flex justify-content-center">
      <ul class="pagination-controls-1">
      <li class="btn-prev"><i class="fas fa-angle-left icon-right" aria-hidden="true"></i><span>Anterior</span></li>
      <li class="btn-next"><span>Próximo</span><i class="fas fa-angle-right icon-next" aria-hidden="true"></i></li>
      </ul>
    </div>

<div class="table-header-title mt-3">Oponentes frequentes</div>
<table id="oponentes-frequentes" class="table table-striped custom-pagination">
    <thead>
        <tr>
            <th class="align-middle" scope="col">Player</th>
            <th class="align-middle" scope="col">Partidas</th>
            <th class="align-middle" scope="col">Vitórias Contra</th>
            <th class="align-middle" scope="col">Empates Contra</th>
            <th class="align-middle" scope="col">Derrotas Contra</th>

        </tr>
    </thead>
    <tbody>
        <tr>
            <td class='col-span' colspan=7>Escolha um jogo para visualizar o ranking.</td>
        </tr>
    </tbody>

</table>
<div class="pagination d-flex justify-content-center">
      <ul class="pagination-controls-2">
      <li class="btn-prev"><i class="fas fa-angle-left icon-right" aria-hidden="true"></i><span>Anterior</span></li>
      <li class="btn-next"><span>Próximo</span><i class="fas fa-angle-right icon-next" aria-hidden="true"></i></li>
      </ul>
    </div>
<script>
    function ajax(url, data1, container) {
        $.ajax({
            url: url,
            method: "get",
            data: data1,
            success: function(data) {


               // console.log("Sucesso=", data)
                $(container).html(data)
                //startPaginator()
                removePagination(data1.nomePaginador)
                startPaginatorParametros(data1.nomeTabela, data1.nomePaginador)
                console.log("Parametros: ",data1)

            },
        })
    }
    $(".mini-card").click(function() {
        $(".mini-card").each(function(index, element) {
            $(element).removeClass("active")
        })
        let elementoAtual = $(this)
        elementoAtual.addClass("active")
        var id_jogo = elementoAtual.attr("id_jogo")
        var id_usuario = parseInt($(".card-usuario").attr("id_usuario"))
       
        ajax("../PHP/gerar-table-estatisticas.php", {
                'id_jogo': id_jogo,
                'id_usuario': id_usuario,
                'tipo_tabela': 'ranking',
                "nomeTabela" : null,
                "nomePaginador":null
            },
            "#ranking tbody")

        ajax("../PHP/gerar-table-estatisticas.php", {
                'id_jogo': id_jogo,
                'id_usuario': id_usuario,
                'tipo_tabela': 'aliados',
                "nomeTabela" : "#aliados-frequentes",
                "nomePaginador":".pagination-controls-1"
            },
            "#aliados-frequentes tbody")

        ajax("../PHP/gerar-table-estatisticas.php", {
                'id_jogo': id_jogo,
                'id_usuario': id_usuario,
                'tipo_tabela': 'oponentes',
                "nomeTabela" : "#oponentes-frequentes",
                "nomePaginador":".pagination-controls-2"
            },
            "#oponentes-frequentes tbody")


    })
</script>