<?php

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
    case 'Login':
        login();
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
        'usuario' => isset($_POST['usuario']) ? $_POST['usuario'] : "",
        'senha' => isset($_POST['senha']) ? $_POST['senha'] : "",
    );
    return $novo;
}

function login(){
    $resultado = false;
    $usuario = tela2array();

    echo($usuario['usuario']);
    echo("<br>");
    echo($usuario['senha']);
    
    if ($usuario['usuario']==="admin"){
        if ($usuario['senha']==="123456"){
            $resultado = true;
        }
    }

    if($resultado){
        session_start();
        $_SESSION['usuario'] = $usuario['usuario'];
        $destino="index.php";
    }else{
        $destino="login.php?error";
    }

    header("location:" . $destino);


}

function logout(){}
?>