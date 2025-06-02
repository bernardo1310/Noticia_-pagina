<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <header class="container">
        <?php include 'noticia_acao.php';
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: login.php");
        }
        $id = isset($_GET['$id']) ? $_GET['$id'] : 0;
        $dados = array();
        if($id!=0)
            $dados = carregar($id);
        ?>
    </header>
    <main class="container">

        <form action="noticia_acao.php" enctype="multipart/form-data" method="post">
            <fieldset>
                <legend>Cadastro de Noticia</legend>

                <label for="id">Id</label>
                <input type="text" name="id" id="id" value="<?= $id ?>" readonly><br>

                <label for="title">Titulo</label>
                <input type="text" size="40" name="title" id="title" value="<?php if ($id != 0)
                    echo $dados['title']; ?>"> <br>

                <label for="resumo">Resumo</labe>
                <input type="text" size="40" name="resumo" id="resumo" value="<?php if ($id != 0)
                    echo $dados['resumo']; ?>"><br>

                <label for="text">Texto</label>
                <input type="text" name="text" id="text" value="<?php if ($id != 0)
                    echo $dados['text']; ?>"><br>

                <label for="autor">Autor</label>
                <input type="text" name="autor" id="autor" value="<?php if ($id != 0)
                    echo $dados['autor']; ?>"><br>

                <label for='tags'>Tags</label>
                <input type="text" name="tags" id="tags" value="<?php if ($id != 0)
                    echo $dados['tags']; ?>"><br>

                <input type="file" name="arquivo" id="" />

                <input class="primary" type="submit" name="acao" id="acao"
                value="<?php if ($id == 0){
                    echo "Salvar";
                } else
                     echo "Alterar";
                ?>">
                <input type="reset" value="Cancelar"/>

            </fieldset>
        </form>
    </main>
    <footer class="container"></footer>
</body>
</html>