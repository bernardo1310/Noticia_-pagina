<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <?php
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location: login.php");
    }
    
    
    ?>
</head>

<body>
    <h1>Bem vindo <?php echo $_SESSION['usuario'];?></h1>

</body>

</html>