<div class="card">
    <div class="card-header">
        Menu <!-- Cabeçalho do menu -matheus -->
    </div>
    <div class="card-body">
        <ul class="nav flex-column"> <!-- Lista de navegação em coluna -matheus -->
            <li class="nav-item">
                <a href="index.php" class="nav-link">Home</a> <!-- Link para a página inicial -matheus -->
            </li>
            <li class="nav-item">
                <a href="usuario_formulario.php" class="nav-link">Cadastre-se</a> <!-- Link para a página de cadastro de usuário -matheus -->
            </li>
            <li class="nav-item">
                <a href="login_formulario.php" class="nav-link">Login</a> <!-- Link para a página de login -matheus -->
            </li>
            <li class="nav-item">
                <a href="post_formulario.php" class="nav-link">Incluir Post</a> <!-- Link para a página de inclusão de post -matheus -->
            </li>
            <?php if((isset($_SESSION['login'])) 
            && ($_SESSION['login']['usuario']['adm'] === 1)) : ?> <!-- Verifica se o usuário está logado e se é administrador -matheus -->
            <li class="nav-item">
                <a href="usuarios.php" class="nav-link">Usuários</a> <!-- Link para a página de gerenciamento de usuários, visível apenas para administradores -matheus -->
            </li>
            <?php endif; ?>
        </ul>
    </div>
</div> <!-- Fim do card do menu -matheus -->
