<table id="table-partidas"class="table table-striped custom-pagination">
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Data</th>
            <th scope="col">Tipo</th>
            <th scope="col">Time vencedor</th>
            <th scope="col">Time derrotado</th>

        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="align-middle">
                <div class="img-icone-game"><img src="../imgs/dama.jpeg"><span>Dama</span></div>
            </td>
            <td class="align-middle">11/12/2020</td>
            <td class="align-middle">2x2</td>
            <td class="align-middle">
                <li class="time-icon"><img src="../imgs/icons/vaca.jpg"> <span>Nickname 1</span></li>
                <li class="time-icon"><img src="../imgs/icons/papagaio.jpg"> <span>Nickname 1</span></li>
            </td>
            <td class="align-middle">
                <li class="time-icon"><img src="../imgs/icons/vaca.jpg"> <span>Nickname 1</span></li>
                <li class="time-icon"><img src="../imgs/icons/papagaio.jpg"> <span>Nickname 1</span></li>
            </td>
        </tr>
        <tr>
            <td>
                <div class="img-icone-game"><img src="../imgs/dama.jpeg"><span>Dama</span></div>
            </td>
            <td class="align-middle">11/12/2020</td>
            <td class="align-middle">1x1</td>
            <td class="align-middle">
                <li class="time-icon"><img src="../imgs/icons/vaca.jpg"> <span>Nickname 1</span></li>
            </td>
            <td class="align-middle">
                <li class="time-icon"><img src="../imgs/icons/vaca.jpg"> <span>Nickname 1</span></li>
            </td>
        </tr>
        <tr>
            <td>
                <div class="img-icone-game"><img src="../imgs/dama.jpeg"><span>Dama</span></div>
            </td>
            <td class="align-middle">11/12/2020</td>
            <td class="align-middle">1x1</td>
            <td class="align-middle">
                <li class="time-icon"><img src="../imgs/icons/vaca.jpg"> <span>Nickname 1</span></li>

            <td>
                <li class="time-icon"><img src="../imgs/icons/vaca.jpg"> <span>Nickname 1</span></li>
            </td>
        </tr>

    </tbody>
</table>


<div class="pagination d-flex justify-content-center">
      <ul class="pagination-controls">
      <li class="btn-prev"><i class="fas fa-angle-left icon-right" aria-hidden="true"></i><span>Anterior</span></li>
      <li class="btn-next"><span>Próximo</span><i class="fas fa-angle-right icon-next" aria-hidden="true"></i></li>
      </ul>
    </div>
    
<script>

function ajax(url, data, container) {
        $.ajax({
            url: url,
            method: "get",
            data: data,
            success: function(data) {


                console.log("Sucesso=", data)
                $(container).html(data)
                console.log("Tamanho = ",$(".custom-pagination tbody tr").length)
                startPaginator()

            },
        })
    }

ajax("../PHP/gerar-table-partidas.php",{
        "id_jogo": 1,
        "id_usuario": parseInt($(".card-usuario").attr("id_usuario")) 
    },"#table-partidas tbody")
</script>