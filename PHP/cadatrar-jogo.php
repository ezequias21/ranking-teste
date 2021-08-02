<?php

require "../config.php";


/**Esta função recebe uma imagem e verifica se:
 *  -   A imagem não está nos formatos jpg, jep e png.
 *  -   A imagem é maior que um tamanho do que 1 MB.
 *  -   Se ocorreu um erro uploading o arquivo.
 * 
 * Se todos esses critérios forem atendidos, é criado um novo nome para imagem baseado e em seguida a imagem é retirada do seu 
 * endereço temporário e colocada dentro do sistema.
 */
function uploadImage($file, $fileName, &$fileLocale)
{
    if (!($fileName == "")) {


        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];


        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = '../imgs/imgs_jogos/' . $fileNameNew;
                    $fileLocale = 'imgs/imgs_jogos/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                } else {
                    /* echo 'O arquivo é muito grande.'; */
                    exit("<div class='alert alert-danger' role='alert'>
                        O arquivo é muito grande. Por favor, selecione um arquivo com no máximo  1 MB.
                        </div>");
                }
            } else {
                /*  echo 'Ocorreu um erro uploading o arquivo.'; */
                exit("<div class='alert alert-danger' role='alert'>
                Ocorreu um erro auploading o arquivo.
                </div>");
            }
        } else {
            /* exit( 'Tipo de arquivo não suportado.'); */
            exit("<div class='alert alert-danger' role='alert'>
                    Tipo de arquivo não suportado. Os arquivos permitidos são jpg, jpeg e png.
                    </div>");
        }
    }
}



if (isset($_POST['nome-jogo'])) {


    $nome = $_POST['nome-jogo'];
    $descricao = $_POST['descricao'];
    $quantidade_de_jogadores_máxima = $_POST["qtde-jogadores"];
    $quantidade_de_jogadores_minima = 2;
    $ocupado = 0;
    $disponivel = $_POST['disponivel'];
    $aceita_empate = 0;
    $link_imagem_jogo = 'imgs/sinuca.jpg';
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileLocale = NULL;
    $modo_de_jogos = $_POST["modos-de-jogo"];
    uploadImage($file, $fileName, $fileLocale);





    $sql = "INSERT INTO jogo (`id`, `nome`, `descricao`, `quantidade_de_jogadores_minima`, `quantidade_de_jogadores_máxima`, 
        `ocupado`, `disponivel`, `aceita_empate`, `link_imagem_jogo`) VALUES (NULL, '$nome', '$descricao',  $quantidade_de_jogadores_minima, $quantidade_de_jogadores_máxima, $ocupado, $disponivel, $aceita_empate, '$fileLocale')";



    if ($conn->query($sql) === TRUE) {

        $sql = "SELECT id from jogo ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql) or die($conn->error);
        if ($result->num_rows > 0) {
            $jogo =  $result->fetch_object();

            $sql = "";
            foreach ($modo_de_jogos as $modo) {
                $sql .= "INSERT INTO modos_de_jogo (id, modos, id_jogo) VALUES (NULL, '$modo', $jogo->id);";
            }

            if ($conn->multi_query($sql) === TRUE) {
                echo "<div class='alert alert-success' role='alert'>
                        Jogo cadastrado com sucesso.
                        </div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>
                        Ocorreu um erro ao cadastrar o jogo.
                        </div>";
            }
        } else {
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
/**Aqui é verificado se o nome de usuário que o usuário digitou já existe no banco de dados. */
if (isset($_POST['searchNickname'])) {

    $serchNickname = $_POST['searchNickname'];
    $sql = "SELECT nickname FROM usuario WHERE nickname = '$serchNickname'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Já existe um usuário com este nome";
    } else {
        echo "Ok";
    }
}

/*Aqui usuário é cadastrado
    */
if (isset($_POST['usuario-cadastrar'])) {

    $nome_usuario = $_POST["nome-usuario"];

    $icon = $_POST["icon"];
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileLocale = NULL;

    uploadImage($file, $fileName, $fileLocale);
    if ($fileLocale <> NULL) {
        $icon = $fileLocale;
    }

    $sql = "INSERT INTO usuario (id, nickname, icon) VALUES (NULL, '$nome_usuario', '$icon')";
    if ($conn->query($sql) === TRUE) {

        echo "<div class='alert alert-success' role='alert'>
                Usuário cadastrado com sucesso.
                </div>";
    } else {

        echo "<div class='alert alert-danger' role='alert'>
                Erro ao inserir usuário.
                </div>";
    }
}




if (isset($_POST["id_usuario_atualizar"])) {
    require "../config.php";


    $id_usuario = $_POST["id_usuario_atualizar"];
    $nickname = $_POST["nome-usuario"];
    


    $icon = $_POST["icon"];
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileLocale = NULL;

    uploadImage($file, $fileName, $fileLocale);
    if ($fileLocale <> NULL) {
        $icon = $fileLocale;
    }

    $sql = "UPDATE usuario
    SET nickname = '$nickname', icon = '$icon' 
    WHERE id = $id_usuario;";

  
    if ($conn->query($sql) === TRUE) {

        echo "<div class='alert alert-success' role='alert'>
                Usuário Atualizado com sucesso.
                </div>";
    } else {

        echo "<div class='alert alert-danger' role='alert'>
                Erro ao atualizar usuário.
                </div>";
    }
}
