<?php



function registrarTime($qtdeJogadores)
{
    require "../config.php";

    $sql = "INSERT INTO time (id, qtde_jogadores) VALUES (NULL, $qtdeJogadores)";
    $result = $conn->query($sql);
    if ($result  === TRUE) {
        $sql = "SELECT id FROM time ORDER BY id DESC LIMIT 1";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $obj =  $result->fetch_object();
            return $obj->id;
        } else {
            echo "Objeto Nulo=";
            return NULL;
        }
    } else {
        return NULL;
    }
}


function registrarCompoe_time($id_usuario, $id_time)
{
    require "../config.php";



    $sql = "INSERT INTO compoe_time (id, id_usuario, id_time) VALUES (NULL, $id_usuario, $id_time)";
    $result = $conn->query($sql);

    echo "Resutado=" . var_dump($result);
    if ($result  != TRUE) {

        return NULL;
    }
}

function getMaximoIdPartida(){
    require "../config.php";
    $sql = "SELECT MAX(id) as id FROM partida";
    $result = $conn->query($sql);
    if (!empty($result) && $result->num_rows > 0) {

        $obj =  $result->fetch_object();
        echo "Id dentro da função partida = $obj->id \n";
        return $obj->id;
    }else{
        echo "Erro ao pegar o id dentro da função partida";
    }
}
function registrarPartida($id_jogo, $id_time, $id_sala, $id_time_oponente, $resultado, $tipo_jogo)
{
    require "../config.php";

    $sql = "";
    $date = new DateTime('NOW', new DateTimeZone('America/Bahia'));
    $dateTime =  $date->format('Y-m-d H:i:s');
    $pontuacao_partida = 1.1;
    echo "Dentro da função registrar partida\n";
    for($i = 0; $i < count($id_time_oponente); $i++){

        $sql .= "INSERT INTO partida (id, id_jogo, id_time, id_time_oponente, id_sala, resultado, pontuacao_partida, data, grupo_individual) VALUES (NULL, $id_jogo, $id_time, $id_time_oponente[$i], $id_sala, $resultado, $pontuacao_partida, '$dateTime', $tipo_jogo);";
        echo "Sql = $sql\n";
    }
    $result =$conn->multi_query($sql);
    echo "Result = " . var_dump($result) . "\n";
    if ($result  !== TRUE) {
    //    echo $result;
        echo "Erro da função registrar partida\n";
        return NULL;
    }else{
        return getMaximoIdPartida();
    }
    echo "Saindo da da função registrar partida\n";
}

function registrarPontuacaoPartida($id_partida, $pontuacao){
    require "../config.php";
    $sql = "UPDATE partida
    SET pontuacao_partida = $pontuacao
    WHERE id = $id_partida";
    $result = $conn->query($sql);
    if($result != true){
        echo "Erro ao atualizar o pontuação da partida";
    }
}
function getPontuacaoUsuario($id_jogador, $id_jogo, $tipo_jogo)
{
    require "../config.php";

    $sql = "SELECT id, pontuacao FROM usuario_pontos
    WHERE id in (SELECT MAX(id)FROM usuario_pontos as u
    WHERE u.grupo_individual = $tipo_jogo AND u.id_jogo = $id_jogo AND u.id_usuario = $id_jogador)";

    echo "Função getPontuacaoUsuario \n";
    echo "Id_jogador = $id_jogador, id_jogo = $id_jogo, tipo_jogo = $tipo_jogo\n";
    $jogador_atual = $conn->query($sql);

    if ($jogador_atual->num_rows > 0) {

        $jogador_atual_pontuacao = $jogador_atual->fetch_object();
        $pontuacao =  $jogador_atual_pontuacao->pontuacao;
    } else {
        $pontuacao = 1600;
    }
    echo "Pontuação = $pontuacao\n";
    return $pontuacao;
}

function calcularPontuacaoTimes($modo_jogo, $tipo_jogo, $id_jogo, $timeVitoria, $timeDerrota)
{
    
    global $pontuacaoTimeVitoria;
    global $pontuacaoTimeDerrota;
    $pontuacaoTimeVitoria = 0;
    $pontuacaoTimeDerrota = 0;
    foreach ($timeVitoria as $time) {

        foreach ($time["integrante"] as $jogador) {
            $pontuacaoTimeVitoria += $jogador["pontuacao"];
            echo "Antes de jogar/ Pontuacao Vitoria 1= " . $pontuacaoTimeVitoria . "\n";
        }
    }

    foreach ($timeDerrota as $time) {
        foreach ($time["integrante"] as $jogador) {
            $pontuacaoTimeDerrota += $jogador["pontuacao"];
            echo "Antes de jogar/ Pontuacao Derrota 1= " . $pontuacaoTimeDerrota . "\n";
        }
    }


    if ($pontuacaoTimeVitoria > $pontuacaoTimeDerrota) {
        echo "Pontuacao vitória antes do calculo= " . $pontuacaoTimeVitoria . "\n";
        echo "Pontuacao Derrota antes do calculo= " . $pontuacaoTimeDerrota . "\n";
        $P = (int)round(abs((($pontuacaoTimeDerrota / $pontuacaoTimeVitoria - 1) * 100) / 2));
        $P > 8 ? $P = 8 : $P;
        echo "Calculo do P= " . $P . "\n";
        $pontuacaoTimeVitoria    = +16 - $P;
        $pontuacaoTimeDerrota = -16 + $P;
        echo "Valor ganho do time vitoria= " . $pontuacaoTimeVitoria . "\n";
        echo "Valor ganho do time derrota= " . $pontuacaoTimeDerrota . "\n";
    } else {
        $P = (int)round(abs((($pontuacaoTimeVitoria / $pontuacaoTimeDerrota - 1) * 100) / 2));
        $P > 8 ? $P = 8 : $P;
        echo "Pontuacao vitória antes do calculo= " . $pontuacaoTimeVitoria . "\n";
        echo "Pontuacao Derrota antes do calculo= " . $pontuacaoTimeDerrota . "\n";
        echo "Calculo do P= " . $P . "\n";
        $pontuacaoTimeVitoria =  16 + $P;
        $pontuacaoTimeDerrota  = -16 - $P;
        echo "Valor ganho do time vitoria= " . $pontuacaoTimeVitoria . "\n";
        echo "Valor ganho do time derrota= " . $pontuacaoTimeDerrota . "\n";
    }

    foreach ($timeVitoria as $time1) {
        $id_partida = $time1["id_partida"];
        foreach ($time1["integrante"] as $jogador1) {
            $jogador_pontuacao =  $jogador1["pontuacao"] +  (int)round($pontuacaoTimeVitoria / intval($time1["qtdeJogadores"], 10));
            $jogador_pontuacao < 0 ? $jogador_pontuacao = 0 :$jogador_pontuacao;
            echo "Divisão dos pontos ganhados do Time vitoria= " . (int)round($pontuacaoTimeVitoria / intval($time1["qtdeJogadores"], 10)) . "\n";
            echo "Soma dos pontos ganhados do Time vitoria com o seus pontos atuais= " . $jogador_pontuacao;
            registrarPontuacaoPartida($id_partida, $pontuacaoTimeVitoria);
            registrarPontuacaoUsuario($jogador1["id"], $id_jogo, $jogador_pontuacao,  $id_partida, $tipo_jogo);
        }
    }
    foreach ($timeDerrota as $time2) {
        $id_partida = $time2["id_partida"];
        foreach ($time2["integrante"] as $jogador2) {
            $jogador_pontuacao = $jogador2["pontuacao"] + (int)round($pontuacaoTimeDerrota / intval($time2["qtdeJogadores"], 10));
            $jogador_pontuacao < 0 ? $jogador_pontuacao = 0 : $jogador_pontuacao;
            echo "Divisão dos pontos ganhados do Time derrota= " . (int)round($pontuacaoTimeDerrota / intval($time2["qtdeJogadores"], 10)) . "\n";
            echo "Soma dos pontos ganhados do Time vitoria com o seus pontos atuais= " . $jogador_pontuacao;
            registrarPontuacaoPartida($id_partida, $pontuacaoTimeDerrota);
            registrarPontuacaoUsuario($jogador2["id"], $id_jogo, $jogador_pontuacao,  $id_partida, $tipo_jogo);
        }
    }
}

function getIdTimeOponente($id_time, $times){
    $times_oponentes = array();
    for($i=0; $i < count($times); $i++){
        if( $id_time != $times[$i]){
            array_push($times_oponentes, $times[$i]);
        }
    }
    return $times_oponentes;
}
function registrarPontuacaoUsuario($id_jogador, $id_jogo, $pontuacao, $id_partida, $grupo_individual)
{
    require "../config.php";
    /* $sql = "UPDATE usuario SET pontuacao = $pontuacao WHERE id = $id_jogador"; */
    echo "Dentro da função registrar Pontuação usuário.\n";
    echo "Registrar usuário = $id_jogador, id_jogo = $id_jogo, pontuação = $pontuacao, id_partida = $id_partida, grupo_individual = $grupo_individual \n";
    $sql = "INSERT INTO usuario_pontos (id, id_usuario, id_jogo, pontuacao, id_partida, grupo_individual) VALUES (NULL, $id_jogador, $id_jogo,  $pontuacao, $id_partida, $grupo_individual)";
    echo "sql = $sql\n";
    $result = $conn->query($sql);
    
    if ($result !=TRUE) {
        echo "Erro " .var_dump($result) . "\n";
    } else {        
        echo "Pontos registrados com sucesso \n";
    }
    echo "Saída da função registrar pontuação usuário";
}



if (isset($_POST["id_jogo"])) {

    $id_jogo = $_POST["id_jogo"];
    $modo_de_jogo = $_POST["modo_de_jogo"];
    $times = $modo_de_jogo["times"];
    $timeVencedor = array();
    $timeDerrotado = array();
    $timeEmpate = array();
    $tipo_jogo = $modo_de_jogo["tipo_jogo"]; //Se o jogo é em grupo ou individual
    $arrayTimes = array();

    echo "Id Jogo = $id_jogo\n";
    
    foreach ($times as &$time) {

        $qtdeJogadores = $time["qtdeJogadores"];
        $integrantes = $time["integrante"];
        $resultado = $time["resultado"];
        $id_time =  registrarTime(intval($qtdeJogadores));
        echo "Id time = $id_time\n";
        array_push($arrayTimes, $id_time);
    }


    $i = 0;
    foreach ($times as &$time) {

        $qtdeJogadores = $time["qtdeJogadores"];
        $integrantes = $time["integrante"];
        $resultado = $time["resultado"];
        echo "Id time = $id_time\n";
        $id_partida = $time["id_partida"] = registrarPartida($id_jogo, $arrayTimes[$i], 1, getIdTimeOponente($arrayTimes[$i], $arrayTimes), $resultado, $tipo_jogo);
        echo "Id da  partida antes foreach = $id_partida \n"; 


        
        foreach ($time["integrante"] as &$jogador) {
            $id_jogador = $jogador["id"];
            $jogador["pontuacao"] = intval(getPontuacaoUsuario($id_jogador, $id_jogo, $tipo_jogo));
            $jogador["id_partida"] =   $id_partida;
            echo "Id da partida dentro do foreach = $id_partida \n"; 
            registrarCompoe_time($id_jogador, $arrayTimes[$i]);
         
        }
        
        if ($time["resultado"] == "0") {
            array_push($timeVencedor, $time);
        }
        if($time["resultado"]=="1"){
            array_push($timeEmpate, $time);
        }
        if ($time["resultado"] == "2") {
            array_push($timeDerrotado, $time);
        }
        $i++;
       
    }
  echo "Time Empate = " . var_dump($timeEmpate) . "\n";

    if(!empty($timeEmpate)){
       echo "";
    }else{
        calcularPontuacaoTimes("",$tipo_jogo,  $id_jogo, $timeVencedor, $timeDerrotado);
    }

    echo "Time vitória Depois: =" . var_dump($timeVencedor) . "\n";
    echo "Time Derrota Depos: =" . var_dump($timeDerrotado) . "\n";

} else {
    echo "Nenhum jogo foi selecionado.";

}
