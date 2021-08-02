<?php
require "../config.php";


function getResultados($id_usuario, $id_jogo, $resultado, $tipo_ranking){
    require "../config.php";
    $grupo = $tipo_ranking == 0 ? 1 : 2;
   $sql = "SELECT COUNT(DISTINCT p.id_time) as resultado FROM partida AS p 
            INNER JOIN time as t 
            ON p.id_time = t.id AND t.qtde_jogadores =  $grupo
            INNER JOIN compoe_time AS ct
            ON p.id_time = ct.id_time AND ct.id_usuario = $id_usuario
            WHERE p.id_jogo = $id_jogo AND p.resultado = $resultado";

$result = $conn->query($sql);
if($result->num_rows > 0){
        $obj = $result->fetch_object();
        return $obj->resultado;
    }else{
        return 0;
    }
    
   
}

function getNumPartidas($id_usuario, $id_jogo, $tipo_ranking){
    require "../config.php";

    $grupo = $tipo_ranking == 0 ? 1 : 2;
   // echo "Tipo rakking = $tipo_ranking\n";
    $sql = "SELECT count(DISTINCT p.id_time) as qtde_partidas FROM partida AS p 
            INNER JOIN time as t 
            ON p.id_time = t.id AND t.qtde_jogadores = $grupo
            INNER JOIN compoe_time AS ct
            ON p.id_time = ct.id_time AND ct.id_usuario = $id_usuario
            WHERE p.id_jogo = $id_jogo";

$result = $conn->query($sql);
if($result->num_rows > 0){
        $obj = $result->fetch_object();
        return $obj->qtde_partidas;
    }else{
        return 0;
    }
    
   
}

/* function gerarTabela($id_jogo){
    require "../config.php";
    //$sql = "SELECT nickname,icon, pontuacao FROM usuario ORDER BY pontuacao DESC LIMIT 5";
    $sql = " SELECT u.id, u.nickname, u.icon, up.pontuacao FROM usuario as u 
    INNER JOIN usuario_pontos as up 
    ON  u.id = up.id_usuario and up.id_jogo = $id_jogo 
    ORDER BY up.pontuacao DESC LIMIT 5";

    $result = $conn->query($sql);
    if($result->num_rows > 0){

    while($obj = $result->fetch_object()){

    //Conta as vitórias do jogador atual
    $resultado = array("vitoria"=>0, "empate"=>1, "derrota"=>"2");
    echo "
    <tr>
    <th class='align-middle' data-title=' scope='row'><img class='trofeu' src='../imgs/trofeu-ouro.jpg' alt='Trofeu ouro'></th>
    <td class='align-middle' data-title='Jogador'><img class='icon-usuario-ranking' src='../" . $obj->icon .   "'><span>" . $obj->nickname . "</span></td>
    <td class='align-middle' data-title='Pontuação'>" . $obj->pontuacao . "</td>
    <td class='align-middle' data-title='Partidas'>" . getNumPartidas($obj->id, $id_jogo) .  "</td>
    <td class='align-middle' data-title='Vitória'>" .  getResultados($obj->id, $id_jogo, $resultado["vitoria"]) .  "</td>
    <td class='align-middle' data-title='Empates'>" .  getResultados($obj->id, $id_jogo, $resultado["empate"]) .  "</td>
    <td class='align-middle' data-title='Derrotas'>" . getResultados($obj->id, $id_jogo, $resultado["derrota"]) .  "</td>
    </tr>
    ";

    }
    }else{
    echo "<tr><td class='col-span' colspan=7>Nenhuma partida foi registrada para este jogo.</td></tr>";
    }


}
 */

function gerarTabelaRanking($id_jogo, $tipo_ranking){
    require "../config.php";
    //$sql = "SELECT nickname,icon, pontuacao FROM usuario ORDER BY pontuacao DESC LIMIT 5";
    $sql = "SELECT up.id, up.id_usuario, up.pontuacao, u.nickname, u.icon FROM usuario_pontos as up
            INNER JOIN usuario as u
            ON u.id = up.id_usuario
            WHERE up.id in
            (SELECT MAX(id)FROM usuario_pontos
            WHERE grupo_individual = $tipo_ranking AND id_jogo = $id_jogo
            GROUP BY id_usuario)
            ORDER BY pontuacao DESC";

    $result = $conn->query($sql);
    if($result->num_rows > 0){

    while($obj = $result->fetch_object()){

    //Conta as vitórias do jogador atual
    $resultado = array("vitoria"=>0, "empate"=>1, "derrota"=>"2");
    $numPartidas =  getNumPartidas($obj->id_usuario, $id_jogo, $tipo_ranking);
    $numVitoria =  getResultados($obj->id_usuario, $id_jogo, $resultado["vitoria"], $tipo_ranking);
    $numEmpate =  getResultados($obj->id_usuario, $id_jogo, $resultado["empate"], $tipo_ranking);
    $derrota =  getResultados($obj->id_usuario, $id_jogo, $resultado["derrota"], $tipo_ranking);
   
    echo "
    <tr>
    <th class='align-middle' data-title=' scope='row'><img class='trofeu' src='../imgs/trofeu-ouro.jpg' alt='Trofeu ouro'></th>
    <td class='align-middle' data-title='Jogador'><img class='icon-usuario-ranking' src='../" . $obj->icon .   "'><span>" . $obj->nickname . "</span></td>
    <td class='align-middle' data-title='Pontuação'>" . $obj->pontuacao . "</td>
    <td class='align-middle' data-title='Partidas'>" .$numPartidas .  "</td>
    <td class='align-middle' data-title='Vitória'>" .  $numVitoria .  "</td>
    <td class='align-middle' data-title='Empates'>" .  $numEmpate .  "</td>
    <td class='align-middle' data-title='Derrotas'>" . $derrota .  "</td>
    </tr>
    ";

    }
    }else{
    echo "<tr><td class='col-span' colspan=7>Nenhuma partida foi registrada para este jogo.</td></tr>";
    }


}

if(isset($_GET["jogo"])){

    $sql = "SELECT id, nome FROM jogo";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0){
       
        echo "<input type='hidden' nome-jogo='" . $obj->nome ."'>
                <option value=0>Selecionar</option>";
        while($obj = $result->fetch_object()){
            echo "<option value=" . $obj->id . ">" . $obj->nome . "</option>";
        }

    }else{
        echo "";
    }
  
}

if(isset($_GET["id_jogo"])){

   
    gerarTabelaRanking($_GET["id_jogo"], $_GET["tipo_ranking"]);
    

}
