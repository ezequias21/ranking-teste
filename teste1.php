<?php


/* $array_resultado = array(2,2,0,2,2,0,0,0,2);


for($i = 0; $i < count($array_resultado); $i++){
    if(intval($array_resultado[$i]) == 0){
        $array_resultado[$i] = 1;
    }else{
        $array_resultado[$i] = -1;
    }
}
echo var_dump($array_resultado) . "<hr>";
for($i = 0; $i < count($array_resultado); $i++){
    $resultado =  intval($array_resultado[$i]);
   if($i == 0){
        $streak = $next = $resultado;
        echo "Streak 1 = $streak";
        echo "next 1 = $next <hr>";
    }else{
        if($next ==  $resultado){
            $streak=  $streak + $resultado;
            echo "Streak 2 = $streak ";
            echo "next 2 = $next <hr>";
      }else{
          break;
      }
    }
}
echo "Streak Final = $streak"; */


/* $timeEmpate = array();

echo "Time Empate = " . var_dump($timeEmpate) . "\n";
echo "Time Empate = " . var_dump(empty($timeEmpate)) . "\n";
if(empty($timeEmpate)){
    echo "Vazio";
} */


function getHistoricoPartida()
{
    require "config.php";

    $sql = "SELECT p.id_time, p.id_time_oponente, p.data, p.resultado, t.qtde_jogadores, p.id_jogo, p.grupo_individual FROM partida as p
        INNER JOIN compoe_time as ct
        ON p.id_time = ct.id_time
        INNER JOIN time as t
        ON p.id_time = t.id
        WHERE ct.id_usuario =16
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
    if(isset($partidas)){
        echo var_dump($partidas);
    }
    for ($i = 0; $i < count($partidas) - 1; $i++) {


        if (intval($partidas[$i]["id_time"]) == intval($partidas[$i + 1]["id_time"])) {
            $next = intval($partidas[$i]["id_time"]);
            echo "if";
            $oponente = [];
            array_push($oponente, $partidas[$i]["id_time_oponente"]);
            array_push($oponente, $partidas[$i + 1]["id_time_oponente"]);
            $partidas[$i - 1]["id_time_oponente"] = $oponente;

            echo var_dump($partidas[$i - 1]["id_time_oponente"]) . "<hr>";
            echo var_dump($partidas[$i]["id_time_oponente"]) . "<hr>";
            unset($oponente);
        } else {
            echo "else-if";
            array_push($id_time_oponente_array, $partidas[$i]["id_time_oponente"]);
            $partidas[$i]["id_time_oponente"] = $id_time_oponente_array;
        }


        //  echo  " " . var_dump($partidas[$i]["id_time_oponente"]) . "<br>";
    }


    // return $partidas;
    // echo var_dump($partidas[0]["id_time_oponente"]) ."<hr>";
    // echo var_dump($partidas[1]["id_time_oponente"]) ."<hr>";
}


function getUsuario($id_time, $id_jogo, $grupo_individual)
{
    require "config.php";
    $sql = "SELECT u.id, u.nickname, u.icon FROM compoe_time as ct 
    INNER JOIN usuario as u
    ON U.id = ct.id_usuario 
    WHERE ct.id_time = $id_time";

    $result = $conn->query($sql);
    $string = "";
    if ($result->num_rows > 0) {
        while ($obj = $result->fetch_object()) {

            //  echo "Id usuario = $obj->id, id-jogo = $id_jogo, grupo-individual = $grupo_individual \n";
            $string .= "<a href='usuario_pontuacao.php?id_usuario=$obj->id'><li class='time-icon'><img src='../" . $obj->icon . "'> <span> $obj->nickname </span><span> (" .  getPontuacao($obj->id, $id_jogo, $grupo_individual) . ")</span> </li><a>";
            //$string .= "<li class='time-icon'><img src='../" . $obj->icon . "'> <span> $obj->nickname </span></li>";
        }
        return $string;
    } else {
        return 0;
    }
}
function getPontuacao($id_usuario, $id_jogo, $tipo_ranking)
{
    require "config.php";
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

function gerarHistoricoPartida($partidas)
{
    foreach ($partidas as $partida) {


        $dateTime = new DateTime($partida["data"]);  //Formata a data que está gravada no banco
        $partida["grupo_individual"] == 0 ? $tipo = "Individual" : $tipo = "Em grupo";   //Verifica a quantidade de jogadores da partida,
        $jogo = $partida["id_jogo"];         //Busca as informações do jogo da partida

        $timeVitoroso = 0;
        $timeDerrotado = 0;
        $id_time  = $partida["id_time"];
        $id_jogo = $partida["id_jogo"];
        $grupo_individual =  $partida["grupo_individual"];
        $id_time_oponente = $partida["id_time_oponente"];
        $resultado = $partida["resultado"];
        if ($resultado == 0) {
            $timeVitoroso = getUsuario($id_time, $id_jogo,  $grupo_individual);
            // $timeDerrotado = getUsuario($id_time_oponente, $id_jogo, $grupo_individual);
        } elseif ($resultado == 2) {

            //$timeVitoroso = getUsuario($id_time_oponente, $id_jogo,  $grupo_individual);
            $timeDerrotado = getUsuario($id_time, $id_jogo, $grupo_individual);
        } else {
            $timeVitoroso = "<strong>(Empate)</strong>" . getUsuario($id_time, $id_jogo,  $grupo_individual);
            //   $timeDerrotado = "<strong>(Empate)</strong>" . getUsuario($id_time_oponente,$id_jogo, $grupo_individual);
        }

        echo "<table><tr>
       
        <td data-title='Data' class='align-middle'>" . $dateTime->format("F j, Y, g:i a") . "</td>
        <td data-title='Tipo 'class='align-middle'> $tipo </td>
        <td data-title='Time Vitorioso' class='align-middle'>" . $timeVitoroso . "</td>
        <td data-title='Time Derrotado' class='align-middle'>" .  $timeDerrotado . "</td>
    </tr></table>";
    }
}



function teste($partidas)
{

    $next = 0;
    $novaPartidaArray = array();

    echo var_dump($partidas);
    if($partidas){
        echo "é sim";
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
    
    $novoarray = [];
    for ($i = 0; $i < count($partidas); $i++) {
        
        
        if (intval($partidas[$i]["id_time_oponente"][0]) != 0) {
            array_push($novoarray, $partidas[$i]);
        }
    }
    
    
    $totalPartidas = count($partidas);
    if ($partidas[$totalPartidas - 1]["id_time"] != $partidas[$totalPartidas - 2]["id_time"]) {
        $id_time_oponente_array = [];
        array_push($id_time_oponente_array, $partidas[$totalPartidas - 1]["id_time_oponente"]);
        $partidas[$i]["id_time_oponente"] = $id_time_oponente_array;
        unset($id_time_oponente_array);
    }
    
    foreach ($novoarray as $novo) {
        
        
        echo  var_dump($novo["id_time"]) . " " . var_dump($novo["id_time_oponente"]) . "<br>";
    }
}
}



$partidas = getHistoricoPartida();
//prepararArrayAssociativoPartidas($partidas);
//gerarHistoricoPartida($partidas);
teste($partidas);
