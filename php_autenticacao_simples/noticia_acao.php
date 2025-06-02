<?php

/*
 * Código de exemplo da utilização de CSV como persistencia
 * Controlador reponsável pela manutenção do cadastro da entidade Pessoa
 * @author Wesley R. Bezerra <wesley.bezerra@ifc.edu.br>
 * @version 0.1
 *
 */

/* definição de constantes */
define("DESTINO", "index.php");
define("ARQUIVO_CSV", "noticia.csv");

/* escolha da ação que processará a requisição */

$acao = "";
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
        break;
    case 'POST':
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
        break;
}
switch ($acao) {
    case 'Salvar':
        salvar();
        break;
    case 'Alterar':
        alterar();
        break;
    case 'excluir':
        excluir();
        break;
    case 'Logout':
        logout();
        break;
}

/*
 * Método que converte formulário html para array com respectivos dados
 * @return array
 */
function tela2array()
{
    $novo = array(
        'id' => isset($_POST['id']) ? $_POST['id'] : date("YmdHis"),
        'title' => isset($_POST['title']) ? $_POST['title'] : "",
        'resumo' => isset($_POST['resumo']) ? $_POST['resumo'] : "",
        'text' => isset($_POST['text']) ? $_POST['text'] : "",
        'autor' => isset($_POST['autor']) ? $_POST['autor'] : "",
        'tags' => isset($_POST['tags']) ? $_POST['tags'] : "",
        'arquivo' => salvarImagem()
    );
    if ($novo['id'] == "0") {
        $novo['id'] = date("YmdHis");
    }
    return $novo;
}

/*
 * Método que converte array para json
 * @return String json
 */
function array2json($array_dados, $json_dados)
{
    $json_dados->id = $array_dados['id'];
    $json_dados->title = $array_dados['title'];
    $json_dados->resumo = $array_dados['resumo'];
    $json_dados->text = $array_dados['text'];
    $json_dados->autor = $array_dados['autor'];
    $json_dados->tags = $array_dados['tags'];
    $json_dados->arquivo = $array_dados['arquivo'];

    return $json_dados;
}
/*
 * Método que salva os dados no formato json no arquivo em disco
 * @param $dados String dados codificados no formato json
 * @param $arquivo String nome do arquivo onde serão salvos os dados
 * @return void
 */
function salvar_csv($dados, $arquivo)
{
    $fp = fopen($arquivo, "w");
    // Popular os dados
    foreach ($dados as $linha) {
        fputcsv($fp, $linha);
    }
    fclose($fp);
}
/*
 * Método que lê os dados no formato json do arquivo em disco
 * @param $arquivo String nome do arquivo onde serão salvos os dados
 * @return String dados codificados no formato json
 */
function ler_csv($arquivo)
{
    $keys = ['id', 'title', 'resumo', 'text', 'autor','tags','arquivo'];
    $fp = fopen($arquivo, "r");
    $dados = array();
    if ($fp) {

        while ($row = fgetcsv($fp, 10000, ",")) {
            $dados[] = array_combine($keys, $row);
        }
    }
    return $dados;
}
/*
 * Método que lê os dados e os carrega em um variável chamada json
 * @param $id int identificador numérico do registro
 * @return String dados codificados no formato json
 */
function carregar($id)
{
    $dados = ler_csv(ARQUIVO_CSV);

    foreach ($dados as $key) {
        if ($key['id'] == $id)
            return $key;
    }
}

/*
 * Método que altera os dados de um registro
 * @return void
 */
function alterar()
{
    $novo = tela2array();

    $dados = ler_csv(ARQUIVO_CSV);

    for ($x = 0; $x < count($dados); $x++) {
        if ($dados[$x]['id'] == $novo['id']) {
            $dados[$x] = $novo;
        }
    }

    salvar_csv($dados, ARQUIVO_CSV);

    header("location:" . DESTINO);

}


/*
1 - abrir json em formato php;
2 - percorrer e achar o item pelo ID;
3 - estratégia de deletar;
4 - gravar em json novamente, sem o item;
5 - redirecionar para a página index.php
*/

/*
 * Método exclui um registro
 * @return void
 */
function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dados = ler_csv(ARQUIVO_CSV);
    if ($dados == null)
        $dados = array();

    $novo = array();
    for ($x = 0; $x < count($dados); $x++) {
        if ($dados[$x]['id'] != $id)
            array_push($novo, $dados[$x]);
    }
    salvar_csv($novo, ARQUIVO_CSV);

    header("location:" . DESTINO);

}
/*
 * Método salva alterações feitas em um registro
 * @return void
 */
function salvar()
{
    $dados = NULL;
    $novo = tela2array();

    $dados = ler_csv(ARQUIVO_CSV);

    if ($dados == NULL) {
        $dados = array();
    }

    array_push($dados, $novo);

    salvar_csv($dados, ARQUIVO_CSV);

    header("location:" . DESTINO);
}

function salvarImagem() {

    $t=time();
    echo($t . "<br>");
    echo(date("Y-m-d",$t));


        $target_dir = "upload/";
        $target_file = $target_dir."".$t . basename($_FILES["arquivo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        //
        $check = getimagesize($_FILES["arquivo"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
      
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["arquivo"]["name"])).
                 " has been uploaded.";
                 return $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }   
}
function Logout(){
    session_start();
    session_unset();
    session_destroy();
    header("location: index.php");
}

?>