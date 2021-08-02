<?php

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

function getResultados($id_usuario, $id_jogo, $resultado, $tipo_ranking)
{
    require "../config.php";
    /* $tipo_ranking == 1 ? $grupo = 2 : $grupo = 1;
    $sql = "SELECT COUNT(DISTINCT p.id_time) as resultado FROM partida AS p 
            INNER JOIN time as t 
            ON p.id_time = t.id AND t.qtde_jogadores =  $grupo
            INNER JOIN compoe_time AS ct
            ON p.id_time = ct.id_time AND ct.id_usuario = $id_usuario
            WHERE p.id_jogo = $id_jogo AND p.resultado = $resultado"; */

    $sql = "SELECT COUNT(DISTINCT p.id_time) as resultado FROM partida AS p 
    INNER JOIN compoe_time AS ct
    ON p.id_time = ct.id_time AND ct.id_usuario = $id_usuario
    WHERE p.id_jogo = $id_jogo AND p.resultado = $resultado AND p.grupo_individual = $tipo_ranking";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $obj = $result->fetch_object();
        return $obj->resultado;
    } else {
        return 0;
    }
}

function getNumPartidas($id_usuario, $id_jogo, $tipo_ranking)
{
    require "../config.php";
    /*$tipo_ranking == 1 ? $grupo = 2 : $grupo = 1;
    echo "id_jogo = $id_jogo, id_usuario = $id_usuario, tipo_ranking = $tipo_ranking";
    $sql = "SELECT count(DISTINCT p.id_time) as qtde_partidas FROM partida AS p 
            INNER JOIN time as t 
            ON p.id_time = t.id AND t.qtde_jogadores = $grupo
            INNER JOIN compoe_time AS ct
            ON p.id_time = ct.id_time AND ct.id_usuario = $id_usuario
            WHERE p.id_jogo = $id_jogo"; */
    $sql = "SELECT count(DISTINCT p.id_time) as qtde_partidas FROM partida AS p 
            INNER JOIN compoe_time AS ct
            ON p.id_time = ct.id_time AND ct.id_usuario = $id_usuario
            WHERE p.id_jogo = $id_jogo AND p.grupo_individual = $tipo_ranking";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $obj = $result->fetch_object();
        return $obj->qtde_partidas;
    } else {
        return 0;
    }
}
function getResultadosUsuariosOponentes($id_usuario, $id_oponente, $id_jogo, $resultado)
{
    require "../config.php";
    $sql = "SELECT count(ct.id_usuario) as resultado FROM compoe_time as ct 
    WHERE ct.id_usuario = $id_oponente AND ct.id_time in
    (SELECT p.id_time_oponente FROM partida as p
    INNER JOIN compoe_time as ct
    ON p.id_time = ct.id_time AND ct.id_usuario = $id_usuario
    WHERE p.resultado = $resultado AND p.id_jogo =$id_jogo)";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $obj = $result->fetch_object();
        return $obj->resultado;
    } else {
        return 0;
    }
}


function createArray($array_resultado){

    $array = array();
    for($i = 0; $i < count($array_resultado); $i++){
        array_push($array, $array_resultado[$i][0]);
        //array_push($array, array_column($array_resultado[$i], "0"));
    }
    return $array;
}
function calcularStreak($array_resultado){
    
    
    $array_resultado =  createArray($array_resultado);
    $streak = 0;
    $next = 0;
    $array_resultado = array_values($array_resultado);

    for($i = 0; $i < count($array_resultado); $i++){
        if(intval($array_resultado[$i]) == 0){
            $array_resultado[$i] = 1;
        }else{
            $array_resultado[$i] = -1;
        }
    }

    for($i = 0; $i < count($array_resultado); $i++){
        $resultado =  intval($array_resultado[$i]);
       if($i == 0){
            $streak = $next = $resultado;
        }else{
            if($next ==  $resultado){
                $streak=  $streak + $resultado;
          }else{
              break;
          }
        }
    }
    return $streak;
}

function getStreak($id_usuario, $id_jogo, $tipo_ranking){
    require "../config.php";

    $sql = "SELECT DISTINCT  p.resultado, P.id_time FROM partida AS p 
    INNER JOIN compoe_time AS ct
    ON p.id_time = ct.id_time AND ct.id_usuario = $id_usuario
    WHERE p.id_jogo = $id_jogo AND p.grupo_individual = $tipo_ranking
    ORDER BY p.data DESC";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return calcularStreak($result->fetch_all(MYSQLI_NUM));
    } else {
        return 0;
    }
    
}
function gerarTabelaEstatistica($id_jogo, $id_usuario)
{
    require "../config.php";

    $resultado = array("vitoria" => 0, "empate" => 1, "derrota" => "2");






    if (getNumPartidas($id_usuario, $id_jogo, 0) || getNumPartidas($id_usuario, $id_jogo, 1)) {

        echo "
        <tr>
        <td data-title='Pontuação'> " . getPontuacao($id_usuario, $id_jogo, 0) . "</td>
            <td data-title='Tipo'>Individual</td>
            <td data-title='Partidas'>" . getNumPartidas($id_usuario, $id_jogo, 0) . "</td>
            <td data-title='Vitórias'> " . getResultados($id_usuario, $id_jogo, $resultado["vitoria"], 0) . "</td>
            <td data-title='Empates'> "  . getResultados($id_usuario, $id_jogo, $resultado["empate"], 0)  . "</td>
            <td data-title='Derrotas'> " . getResultados($id_usuario, $id_jogo, $resultado["derrota"], 0) . "</td>
            <td data-title='Streak'> " . getStreak($id_usuario, $id_jogo, 0) . "</td>
        </tr>
        ";

        echo "
        <tr>
            <td data-title='Pontuação'>" . getPontuacao($id_usuario, $id_jogo, 1) . "</td>
            <td data-title='Tipo'>Em grupo</td>
            <td data-title='Partidas'>" . getNumPartidas($id_usuario, $id_jogo, 1) . "</td>
            <td data-title='Vitória'> "  . getResultados($id_usuario, $id_jogo, $resultado["vitoria"], 1) . "</td>
            <td data-title='Empates'> "  . getResultados($id_usuario, $id_jogo, $resultado["empate"], 1)  . "</td>
            <td data-title='Derrotas'>"  . getResultados($id_usuario, $id_jogo, $resultado["derrota"], 1) . "</td>
            <td data-title='Streak'>" . getStreak($id_usuario, $id_jogo, 1). "</td>
         </tr>";
    } else {
        echo "<tr><td class='col-span' colspan=7>Nenhuma partida foi registrada para este jogo.</td></tr>";
    }
}


function gerarTabelaOponentes($id_jogo, $id_usuario)
{
    require "../config.php";
    $resultado = array("vitoria" => 0, "empate" => 1, "derrota" => "2");


    $sql = "SELECT ct.id_usuario as oponente, count(ct.id_usuario) as numero_partidas, u.nickname, u.icon FROM compoe_time as ct 
            INNER JOIN usuario as u
            ON ct.id_usuario = u.id
            WHERE ct.id_time in (SELECT id_time_oponente FROM partida as p
            INNER JOIN compoe_time as ct
            ON p.id_time = ct.id_time
            WHERE ct.id_usuario = $id_usuario AND p.id_jogo = $id_jogo
            ORDER BY p.data DESC)
            GROUP BY oponente
            ORDER BY numero_partidas DESC";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

      
        while ($obj = $result->fetch_object()) {

            echo "<tr>
            <td data-title='Player'>
            <div class='container-usuario'>
                <img class='icon-usuario-ranking' src='../" . $obj->icon . "'>
                <span>" . $obj->nickname . "</span>
                </div>
            </td>
            <td data-title='Partidas'>" . $obj->numero_partidas . "</td>
            <td data-title='Vitórias'>" . getResultadosUsuariosOponentes($id_usuario, $obj->oponente, $id_jogo, $resultado["vitoria"]) . "</td>
            <td data-title='Empates'> " . getResultadosUsuariosOponentes($id_usuario, $obj->oponente, $id_jogo, $resultado["empate"]) . "</td>
            <td data-title='Derrotas'>" . getResultadosUsuariosOponentes($id_usuario, $obj->oponente, $id_jogo, $resultado["derrota"]) . "</td>
        </tr>";
        }
    } else {
        echo "<tr><td class='col-span' colspan=7>Você ainda não tem nenhum aliado.</td></tr>";
    }
}

function getResultadosUsuariosAliados($id_usuario, $aliado, $id_jogo, $resultado)
{
    require "../config.php";
    $sql = "SELECT count(ct.id) as resultado FROM compoe_time as ct 
    WHERE ct.id_usuario = $aliado AND ct.id_time in (SELECT ct.id_time as time FROM compoe_time as ct
    INNER JOIN time as t
    ON ct.id_time = t.id AND t.qtde_jogadores =2
    INNER JOIN partida as p 
    ON p.id_time = t.id AND p.resultado = $resultado AND p.id_jogo = $id_jogo                             
    WHERE ct.id_usuario = $id_usuario)";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $obj = $result->fetch_object();
        return $obj->resultado;
    } else {
        return 0;
    }
}
function gerarTabelaAlidados($id_jogo, $id_usuario)
{ 
        require "../config.php";
        $resultado = array("vitoria" => 0, "empate" => 1, "derrota" => "2");


        $sql = "SELECT ct.id_usuario as aliado, u.nickname, u.icon, count(ct.id_usuario) as numero_partidas FROM compoe_time as ct
        INNER JOIN usuario as u
        ON u.id = ct.id_usuario
        WHERE ct.id_time in (SELECT ct.id_time as time FROM compoe_time as ct
        INNER JOIN time as t
        ON ct.id_time = t.id AND t.qtde_jogadores =2
        INNER JOIN partida as p
        ON p.id_time = ct.id_time AND p.id_jogo = $id_jogo
        WHERE ct.id_usuario = $id_usuario) AND ct.id_usuario <> $id_usuario
        GROUP BY ct.id_usuario 
        ORDER BY numero_partidas DESC";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            while ($obj = $result->fetch_object()) {

                echo "<tr>
                <td data-title='Player'>
                    <div class='container-usuario'>
                    <img class='icon-usuario-ranking' src='../" . $obj->icon . "'>
                    <span>" . $obj->nickname . "</span>
                    </div>
                </td>
                <td data-title='Partidas'>" . $obj->numero_partidas . "</td>
                <td data-title='Vitórias'>" . getResultadosUsuariosAliados($id_usuario, $obj->aliado, $id_jogo, $resultado["vitoria"]) . "</td>
                <td data-title='Empates'> " . getResultadosUsuariosAliados($id_usuario, $obj->aliado, $id_jogo, $resultado["empate"]) . "</td>
                <td data-title='Derrotas'>" . getResultadosUsuariosAliados($id_usuario, $obj->aliado, $id_jogo, $resultado["derrota"]) . "</td>
            </tr>";
            }
        } else {
            echo "<tr><td class='col-span' colspan=7>Você ainda não tem nenhum Oponente.</td></tr>";
        }
    
}
if (isset($_GET["id_jogo"])) {


    switch ($_GET["tipo_tabela"]) {
        case "ranking":
            gerarTabelaEstatistica($_GET["id_jogo"], $_GET["id_usuario"]);
            break;

        case "aliados":
            gerarTabelaAlidados($_GET["id_jogo"], $_GET["id_usuario"]);
            break;
            
        case "oponentes":
            gerarTabelaOponentes($_GET["id_jogo"], $_GET["id_usuario"]);
            break;
    }
}
