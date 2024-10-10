<?php
    // Armazena a URL atual na sessão para poder retornar após o login -matheus
    $_SESSION['url_retorno'] = $_SERVER['PHP_SELF'];

    // Verifica se a variável de sessão 'login' não está definida (ou seja, o usuário não está logado) -matheus
    if(!isset($_SESSION['login'])){
        // Redireciona o usuário para a página de login se não estiver logado -matheus
        header('Location: login_formulario.php');
        exit; // Termina a execução do script após o redirecionamento -matheus
    }
?>
