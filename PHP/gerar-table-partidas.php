<?php



function getJogo($id_jogo)
{
    require "../config.php";
    $sql = "SELECT nome, link_imagem_jogo FROM jogo
            WHERE id = $id_jogo";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $obj = $result->fetch_object();
        return array("nome" => $obj->nome, "link_imagem_jogo" => $obj->link_imagem_jogo);
    } else {
        return 0;
    }
}
function getPontuacao($id_usuario, $id_jogo, $tipo_ranking)
{
    require "../config.php";
    $sql = "SELECT pontuacao FROM usuario_pontos 
    WHERE id in (SELECT MAX(id)FROM usuario_pontos
    WHERE grupo_individual = $tipo_ranking AND id_jogo =  $id_jogo AND id_usuario = $id_usuario)
    ";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $obj = $result->fetch_object();
        $obj->pontuacao = $obj->pontuacao < 0 ? 0 : $obj->pontuacao;
        return $obj->pontuacao;
    } else {
        return 1600;
    }
}

function getUsuario($id_time, $id_jogo, $grupo_individual)
{
    require "../config.php";
    $sql = "SELECT u.id, u.nickname, u.icon FROM compoe_time as ct 
    INNER JOIN usuario as u
    ON U.id = ct.id_usuario 
    WHERE ct.id_time = $id_time";

    $result = $conn->query($sql);
    $string = "";
    if ($result->num_rows > 0) {
        while ($obj = $result->fetch_object()) {

            echo "Id usuario = $obj->id, id-jogo = $id_jogo, grupo-individual = $grupo_individual \n";
            $string .= "<a href='usuario_pontuacao.php?id_usuario=$obj->id'><li class='time-icon'><img src='../" . $obj->icon . "'> <span> $obj->nickname </span><span> (" .  getPontuacao($obj->id, $id_jogo, $grupo_individual) . ")</span> </li></a>";
            //$string .= "<li class='time-icon'><img src='../" . $obj->icon . "'> <span> $obj->nickname </span></li>";
        }
        return $string;
    } else {
        return $id_time[0];
    }
}


function getHistoricoPartida()
{
    require "../config.php";

    $sql = "SELECT p.id_time, p.id_time_oponente, p.data, p.resultado, t.qtde_jogadores, p.id_jogo, p.grupo_individual FROM partida as p
        INNER JOIN compoe_time as ct
        ON p.id_time = ct.id_time
        INNER JOIN time as t
        ON p.id_time = t.id
        WHERE ct.id_usuario = $id_usuario
        ORDER BY p.data DESC";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($obj = $result->fetch_object()) {
            $partida = array("id_time" => 0, "id_time_oponente" => $obj->id_time_oponente, "derrota" => "2");
        }
    }
}


function getResultadosHistoricoPartida($id_usuario)
{
    require "../config.php";

    $sql = "SELECT p.id, p.id_time, p.id_time_oponente, p.data, p.resultado, t.qtde_jogadores, p.id_jogo, p.grupo_individual FROM partida as p
        INNER JOIN compoe_time as ct
        ON p.id_time = ct.id_time
        INNER JOIN time as t
        ON p.id_time = t.id
        WHERE ct.id_usuario =$id_usuario
        ORDER BY p.data DESC";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $obj = $result->fetch_all(MYSQLI_ASSOC);
        return $obj;
        // echo  var_dump($obj[0]["id_time"]);
    }
}

function prepararArrayAssociativoPartidas($partidas)
{

    $next = 0;
    $novaPartidaArray = array();
    if ($partidas) {
        for ($i = 0; $i < count($partidas) - 1; $i++) {


            if (intval($partidas[$i]["id_time"]) == intval($partidas[$i + 1]["id_time"])) {
                $next = intval($partidas[$i]["id_time"]);
                $oponente = [];
                array_push($oponente, $partidas[$i]["id_time_oponente"]);
                array_push($oponente, $partidas[$i + 1]["id_time_oponente"]);
                $partidas[$i]["id_time_oponente"] = $oponente;
                $partidas[$i + 1]["id_time_oponente"] = 0;

                unset($oponente);
            } else {
                $id_time_oponente_array = [];
                array_push($id_time_oponente_array, $partidas[$i]["id_time_oponente"]);
                $partidas[$i]["id_time_oponente"] = $id_time_oponente_array;
                unset($id_time_oponente_array);
            }
        }

        $id_time_oponente_array = [];
        array_push($id_time_oponente_array, $partidas[$i]["id_time_oponente"]);
        $partidas[count($partidas) - 1]["id_time_oponente"] = $id_time_oponente_array;
        unset($id_time_oponente_array);



        /* $totalPartidas = count($partidas);
    if( $totalPartidas > 1){
        if ($partidas[$totalPartidas - 1]["id_time"] != $partidas[$totalPartidas - 2]["id_time"]) {
            $id_time_oponente_array = [];
            array_push($id_time_oponente_array, $partidas[$totalPartidas - 1]["id_time_oponente"]);
            $partidas[$i]["id_time_oponente"] = $id_time_oponente_array;
            unset($id_time_oponente_array);
        }

    } */
        $novoarray = [];
        for ($i = 0; $i < count($partidas); $i++) {

            if (intval($partidas[$i]["id_time_oponente"][0]) != 0) {
                array_push($novoarray, $partidas[$i]);
            }
        }


        return $novoarray;
    } else {
        return NULL;
    }
}


function comporTime($id_timeOponente, $id_jogo, $grupo_individual)
{
    $time = "";
    foreach ($id_timeOponente as $id_oponente) {
        $time .= getUsuario($id_oponente, $id_jogo,  $grupo_individual);
    }
    return $time;
}

function getIdPartidaTimeOponente($id_time_oponente)
{
    require "../config.php";
    $sql = "SELECT MAX(p.id) as id_partida FROM partida as p 
    WHERE p.id_time = $id_time_oponente";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $obj = $result->fetch_object();
        $obj->pontuacao = $obj->pontuacao < 0 ? 0 : $obj->pontuacao;
        return $obj->id_partida;
    } else {
        return 0;
    }
}
function gerarHistoricoPartida($id_jogo, $id_usuario)
{



    $partidas = getResultadosHistoricoPartida($id_usuario);
    $partidas = prepararArrayAssociativoPartidas($partidas);
    if ($partidas) {
        foreach ($partidas as $partida) {



            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');
            $newdate  =  strftime('%d de %B de %Y, %H:%M', strtotime($partida["data"]));

            $partida["grupo_individual"] == 0 ? $tipo = "Individual" : $tipo = "Em grupo";   //Verifica a quantidade de jogadores da partida,
            $jogo = $partida["id_jogo"];         //Busca as informações do jogo da partida

            $timeVitoroso = 0;
            $timeDerrotado = 0;
            $id_partida = $partida["id"];
            $id_time  = $partida["id_time"];
            $id_jogo = $partida["id_jogo"];
            $grupo_individual =  $partida["grupo_individual"];
            $id_times_oponente = $partida["id_time_oponente"];
            $resultado = $partida["resultado"];
            $jogo = getJogo($partida["id_jogo"]);


            if ($resultado == 0) {
                $timeVitoroso = getUsuario($id_time, $id_jogo,  $grupo_individual);
                // $timeDerrotado = getUsuario($id_time_oponente, $id_jogo, $grupo_individual);
                $timeDerrotado = comporTime($id_times_oponente, $id_jogo,  $grupo_individual);
            } elseif ($resultado == 2) {

                //$timeVitoroso = getUsuario($id_time_oponente, $id_jogo,  $grupo_individual);
                $timeVitoroso = comporTime($id_times_oponente, $id_jogo,  $grupo_individual);
                $timeDerrotado = getUsuario($id_time, $id_jogo, $grupo_individual);
            } else {
                $timeVitoroso = "<strong>(Empate)</strong>" . getUsuario($id_time, $id_jogo,  $grupo_individual);
                $timeDerrotado = "<strong>(Empate)</strong>" . comporTime($id_times_oponente, $id_jogo,  $grupo_individual);
                //   $timeDerrotado = "<strong>(Empate)</strong>" . getUsuario($id_time_oponente,$id_jogo, $grupo_individual);
            }

            echo "<tr>
                            <td class='align-middle'>
                                <a href='ranking-total.php?id_jogo=$id_jogo'><div class='img-icone-game'><img src='../" . $jogo["link_imagem_jogo"] . "'><span> " . $jogo["nome"] . "</span></div></a>
                            </td>
                            <td data-title='Data' class='align-middle'>" . $newdate . "</td>
                            <td data-title='Tipo 'class='align-middle'> $tipo </td>
                            <td data-title='Time Vitorioso' class='align-middle'>" . $timeVitoroso . "</td>
                            <td data-title='Time Derrotado' class='align-middle'>" .  $timeDerrotado . "</td>
                        </tr>";
        }
    } else {
        echo "<tr><td class='col-span' colspan=7>Registre uma partida e ela aparecerá aqui.</td></tr>";
    }
}

/* function gerarHistoricoPartida($id_jogo, $id_usuario)
{
    require "../config.php";
    $resultado = array("vitoria" => 0, "empate" => 1, "derrota" => "2");


    $sql = "SELECT p.id_time, p.id_time_oponente, p.data, p.resultado, t.qtde_jogadores, p.id_jogo, p.grupo_individual FROM partida as p
        INNER JOIN compoe_time as ct
        ON p.id_time = ct.id_time
        INNER JOIN time as t
        ON p.id_time = t.id
        WHERE ct.id_usuario = $id_usuario
        ORDER BY p.data DESC";

    $result = $conn->query($sql);
    $anterior = 0;
    $i = 0;

    if ($result->num_rows > 0) {
        $i = 0;
        $anterior = 0;

        $nextTimeAtual = 0;
        while ($obj = $result->fetch_object()) {

            
            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');
            $newdate  =  strftime('%d de %B de %Y, %H:%M', strtotime($obj->data));

            $obj->grupo_individual == 0 ? $tipo = "Individual" : $tipo = "Em grupo";   //Verifica a quantidade de jogadores da partida,
            $jogo = getJogo($obj->id_jogo);         //Busca as informações do jogo da partida
            $timeVitoroso = 0;
            $timeDerrotado = 0;
            if ($obj->resultado == 0) {
                $timeVitoroso = getUsuario($obj->id_time, $obj->id_jogo,  $obj->grupo_individual);
                $timeDerrotado = getUsuario($obj->id_time_oponente, $obj->id_jogo,  $obj->grupo_individual);
            } elseif ($obj->resultado == 2) {

                $timeVitoroso = getUsuario($obj->id_time_oponente, $obj->id_jogo,  $obj->grupo_individual);
                $timeDerrotado = getUsuario($obj->id_time, $obj->id_jogo,  $obj->grupo_individual);
            } else {
                $timeVitoroso = "<strong>(Empate)</strong>" . getUsuario($obj->id_time, $obj->id_jogo,  $obj->grupo_individual);
                $timeDerrotado = "<strong>(Empate)</strong>" . getUsuario($obj->id_time_oponente, $obj->id_jogo,  $obj->grupo_individual);
            }


            echo "<tr>
                            <td class='align-middle'>
                                <div class='img-icone-game'><img src='../" . $jogo["link_imagem_jogo"] . "'><span> " . $jogo["nome"] . "</span></div>
                            </td>
                            <td data-title='Data' class='align-middle'>" . $newdate . "</td>
                            <td data-title='Tipo 'class='align-middle'> $tipo </td>
                            <td data-title='Time Vitorioso' class='align-middle'>" . $timeVitoroso . "</td>
                            <td data-title='Time Derrotado' class='align-middle'>" .  $timeDerrotado . "</td>
                        </tr>";
        }
    } else {
        echo "<tr><td class='col-span' colspan=7>Registre uma partida e ela aparecerá aqui.</td></tr>";
    }
} */


if (isset($_GET["id_jogo"])) {

    gerarHistoricoPartida($_GET["id_jogo"], $_GET["id_usuario"]);
    echo "Usuario = " . $_GET["id_usuario"];
}
