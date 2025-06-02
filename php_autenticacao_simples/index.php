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
    <div class="container">
        <?php
        session_start();
        if (isset($_SESSION['usuario'])) {
            include 'navbaradm.php';
        } else {
            include 'navbar.php';
        }
        ?>
        <!--
        <nav>
        <div class="nav-wrapper sua-classe-navbar">
            <a href="#" class="brand-logo">SITE DO G1</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="index.php">Noticias</a></li>
            <li><a href="noticia_cad.php">Logar</a></li>
            <li><a href="noticia_acao.php?acao=Logout">Desconectar</a></li>
            </ul>
        </div>
        </nav> 
        -->
        <div class="row">
        <?php 
        
        include "noticia_acao.php";

        $dados = ler_csv('noticia.csv');
            if(($dados == NULL) || (count($dados)==0)){
                echo "<h1>sem dados a serem exibidos</h1>";
            }
            foreach($dados as $key)
            echo "<div class='col s12 m4'>
                    <div class='card'>
                        <div class='card-image'>
                        <img src='{$key['arquivo']}'>
                        <span class='card-title'>{$key['title']}</span>
                        </div>
                        <div class='card-content'>
                        <p>{$key['text']}</p>
                        </div>
                    </div>
                    </div>";
        ?>
        </div>
    </div>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<!--             $dados = ler_csv('pessoa.csv');
            if(($dados == NULL) || (count($dados)==0)){
                echo "<h1>sem dados a serem exibidos</h1>";
            }
            foreach ($dados as $key)
                echo "<tr><td>{$key['id']}</td>
                  <td>{$key['nome']}</td>
                  <td>{$key['altura']}</td>
                  <td>{$key['peso']}</td>
                  <td align='center'><a role='button' href='pessoa_cad.php?id=" . $key['id'] . "';>A</a></td>
                  <td align='center'><a role='button' href=javascript:excluirRegistro('pessoa_acao.php?acao=excluir&id=" . $key['id'] . "');>E</a></td>
              </tr>";
            -->
</body>
</html>