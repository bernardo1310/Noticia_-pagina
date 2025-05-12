<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Exemplo de Autenticacao Simples</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    <?php
    if (isset($_GET["error"])) {
        echo "<h1>Usuário/senha inválido!</h1>";
    }
    ?>
    <form method="post" action="login_acao.php">
        <input name="usuario" type="text" placeholder="usuário"/>
        <input name="senha" type="password" placeholder="senha"/>
        <input type="submit" name="acao" value="Login"/>
    </form>
</body>
</html>