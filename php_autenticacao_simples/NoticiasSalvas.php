<?php 
 include "noticia_acao.php";
?>


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
<main class="container">
    <?php
        session_start();
        if (isset($_SESSION['usuario'])) {
            include 'navbaradm.php';
        } else {
            include 'navbar.php';
        }
    ?>
    <table role="grid">
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Resumo</th>
                <th>Texto</th>
                <th>Autor</th>
                <th>Tags</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
            <?php
                $dados = ler_csv('noticia.csv');
                if(($dados == NULL) || (count($dados)==0)){
                    echo "<h1>sem dados a serem exibidos</h1>";
                }
                foreach ($dados as $key)
                    echo "<tr><td>{$key['id']}</td>
                    <td>{$key['title']}</td>
                    <td>{$key['resumo']}</td>
                    <td>{$key['text']}</td>
                    <td>{$key['autor']}</td>
                    <td>{$key['tags']}</td>
                    <td align='center'><a role='button' href='noticia_cad.php?id=" . $key['id'] . "';>A</a></td>
                    <td align='center'><a role='button' href=javascript:excluirRegistro('noticia_acao.php?acao=excluir&id=" . $key['id'] . "');>E</a></td>
                </tr>";
            ?>
        </table>
    </main>
        <!-- funcao de confirmacacao em javascript para a exclusao-->
        <script>''
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
</body>
</html>