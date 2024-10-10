<?php
session_start();
require_once '../includes/funcoes.php';
require_once 'conexao_mysql.php';
require_once 'sql.php';
require_once 'mysql.php';

$salt = '$exemplosaltifsp';

// Limpa os dados de entrada
foreach ($_POST as $indice => $dado) {
    $$indice = limparDados($dado);
}

foreach ($_GET as $indice => $dado) { 
    $$indice = limparDados($dado);
}

// Switch para determinar a ação a ser executada
switch ($acao) {
    case 'insert':
        $dados = [
            'nome' => $nome,
            'email' => $email,
            'senha' => crypt($senha, $salt) // Criptografa a senha
        ];

        insere('usuario', $dados); // Insere o novo usuário
        break;

    case 'update':
        $id = (int)$id; // Converte o ID para um inteiro
        $dados = [
            'nome' => $nome,
            'email' => $email
        ];

        $criterio = [['id', '=', $id]]; // Critério para atualização

        atualiza('usuario', $dados, $criterio); // Atualiza os dados do usuário
        break;

    case 'login':
        $criterio = [
            ['email', '=', $email],
            ['AND', 'ativo', '=', 1] // Verifica se o usuário está ativo
        ];

        $retorno = buscar(
            'usuario',
            ['id', 'nome', 'email', 'senha', 'adm'],
            $criterio
        );

        if(count($retorno) > 0) {
            if(crypt($senha, $salt) == $retorno[0]['senha']) {
                $_SESSION['login']['usuario'] = $retorno[0]; // Inicia sessão para o usuário
                if(!empty($_SESSION['url_retorno'])) {
                    header('Location: ' . $_SESSION['url_retorno']); // Redireciona para a URL de retorno
                    $_SESSION['url_retorno'] = '';
                    exit;
                }
            }
        }
        break;

    case 'logout':
        session_destroy(); // Finaliza a sessão
        break;

    case 'status':
        $id = (int)$id;
        $valor = (int)$valor;

        $dados = [
            'ativo' => $valor // Atualiza o status do usuário
        ];

        $criterio = [['id', '=', $id]];
        atualiza('usuario', $dados, $criterio);

        header('Location: ../usuarios.php'); // Redireciona para a página de usuários
        exit;
        break;

    case 'adm':
        $id = (int)$id;
        $valor = (int)$valor;

        $dados = [
            'adm' => $valor // Atualiza se o usuário é administrador
        ];

        $criterio = [['id', '=', $id]];
        atualiza('usuario', $dados, $criterio);

        header('Location: ../usuarios.php'); // Redireciona para a página de usuários
        exit;
        break;
}

header('Location: ../index.php'); // Redireciona para a página inicial
?>
