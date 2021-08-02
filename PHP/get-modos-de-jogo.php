
<?php

require "../config.php";
header('Content-Type: application/json');

/**Aqui é exibido os modos de jogo */
if(isset($_POST['id_jogo'])){

    $id_jogo = $_POST['id_jogo'];
    $sql = "SELECT modos, id_jogo from modos_de_jogo as mj
        WHERE id_jogo = " . $id_jogo ."";

    $result = $conn->query($sql) or die($conn->error);
    echo json_encode($result->fetch_all(1));
}

?>