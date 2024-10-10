<?php
session_start(); // Inicia a sessão do PHP
require_once '../includes/valida_login.php'; // Valida o login do usuário
require_once '../includes/funcoes.php'; // Inclui funções auxiliares
require_once 'conexao_mysql.php'; // Inclui a função de conexão com o MySQL
require_once 'sql.php'; // Inclui definições de instruções SQL
require_once 'mysql.php'; // Inclui funções de manipulação do banco de dados

// Limpa os dados recebidos via POST
foreach($_POST as $indice => $dado) {
    $$indice = limparDados($dado); // Limpa e atribui os dados a variáveis dinâmicas
}

// Limpa os dados recebidos via GET
foreach($_GET as $indice => $dado) {
    $$indice = limparDados($dado); // Limpa e atribui os dados a variáveis dinâmicas
}

// Converte o ID para inteiro
$id = (int)$id;

// Realiza ações com base na variável de ação recebida
switch($acao) {
    case 'insert': // Inserir nova postagem
        $dados = [
            'titulo' => $titulo,
            'texto' => $texto,
            'data_postagem' => "$data_postagem $hora_postagem", // Combina data e hora
            'usuario_id' => $_SESSION['login']['usuario']['id'] // ID do usuário logado
        ];

        // Chama a função insere para adicionar a nova postagem
        insere(
            'post',
            $dados
        );

        break;
    case 'update': // Atualizar uma postagem existente
        $dados = [
            'titulo' => $titulo,
            'texto' => $texto,
            'data_postagem' => "$data_postagem $hora_postagem",
            'usuario_id' => $_SESSION['login']['usuario']['id']
        ];

        // Define o critério de atualização (baseado no ID da postagem)
        $criterio = [
            ['id', '=', $id]
        ];

        // Chama a função atualiza para modificar a postagem
        atualiza(
            'post',
            $dados,
            $criterio
        );

        break;
    case 'delete': // Deletar uma postagem
        // Define o critério de deleção (baseado no ID da postagem)
        $criterio = [
            ['id', '=', $id]
        ];

        // Chama a função deleta para remover a postagem
        deleta(
            'post',
            $criterio
        );
        
        break;
}

// Redireciona para a página inicial após a operação
header('Location: ../index.php');
?>
