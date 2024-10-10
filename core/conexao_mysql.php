<?php

// Função que realiza a conexão com o banco de dados MySQL -matheus
function conecta() : mysqli
{
    // Configurações do banco de dados -matheus
    $servidor = 'localhost'; // Endereço do servidor do banco de dados
    $banco = 'blog';
    $port = 3307; 
    $usuario = 'root'; 
    $senha = ""; // 

    // Cria a conexão com o MySQL usando as variáveis definidas -matheus
    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco, $port);

    // Verifica se houve algum erro na conexão -matheus
    if(!$conexao){
        // Se houver erro, exibe uma mensagem de erro e o motivo -matheus
        echo 'Erro: Não foi possível conectar ao MySQL.' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
        echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
        return null; // Retorna null se a conexão falhar -matheus
    }

    // Retorna a conexão se tudo estiver correto -matheus
    return $conexao;
}

// Função para desconectar do banco de dados -matheus
function desconecta(mysqli $conexao) : void
{
    // Fecha a conexão com o banco de dados MySQL -matheus
    mysqli_close($conexao);
}

?>
