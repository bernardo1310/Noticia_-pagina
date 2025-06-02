<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Exemplo de Autenticacao Simples</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <?php
    if (isset($_GET["error"])) {
        echo "<h1>Usuário/senha inválido!</h1>";
    }
    ?>

    <div class="row" style="margin-left: 800px;" >
            <div class="col s12 m4">
                <div class="card" style="padding: 2px 40px 40px;">
                    <h1 style="text-align: center;">LOGIN</h1>
                    <div class="card-image">
                        <form method="post" action="login_acao.php">
                            <input name="usuario" type="text" placeholder="usuário"/>
                            <input name="senha" type="password" placeholder="senha"/>
                            <input type="submit" name="acao" value="Login"/>
                        </form>
                    </div>
                </div>
            </div>
</body>
</html>