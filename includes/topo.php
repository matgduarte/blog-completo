<?php
    session_start(); // Inicia a sessão para permitir o uso de variáveis de sessão -matheus
?>

<div class="card mb-3 mt-3">
    <div class="card-header">
        <!-- Título do projeto exibido no cabeçalho do card -matheus -->
        <h1>Projeto Blog em PHP super foda | Matheus</h1>
    </div>
    <?php if(isset($_SESSION['login'])) : ?> <!-- Verifica se o usuário está logado através da variável de sessão -matheus -->
        <div class="card-body text-right">
            <!-- Mensagem de saudação com o nome do usuário logado -matheus -->
            Olá <?php echo $_SESSION['login']['usuario']['nome']?>!
            <!-- Link para logout que direciona para o repositório do usuário -matheus -->
            <a href="core/usuario_repositorio.php?acao=logout" 
            class="btn btn-link btn-sm" role="button">Sair</a>
        </div>
    <?php endif ?> <!-- Fim da verificação se o usuário está logado -matheus -->
</div>
