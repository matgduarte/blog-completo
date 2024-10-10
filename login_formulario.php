<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Projeto para Web com PHP</title>
    <link rel="stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
    <!-- Inclui o CSS do Bootstrap para a estilização do formulário de login -matheus -->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Inclui o topo da página a partir do arquivo 'topo.php' -matheus -->
                <?php include 'includes/topo.php'; ?>
            </div>
        </div>
        <div class="row" style="min-height: 500px;">
            <div class="col-md-12" >
                <!-- Inclui o menu da página a partir do arquivo 'menu.php' -matheus -->
                <?php include 'includes/menu.php'; ?>
            </div>
            <div class="col-md-10" style="padding-top: 50px;">
                <!-- Cabeçalho da seção de login -matheus -->
                <div class="card-header">Login</div>
                <div class="card-body">
                    <!-- Formulário de login que envia os dados para 'usuario_repositorio.php' -matheus -->
                    <form action="core/usuario_repositorio.php" method="post">
                        <!-- Campo oculto que define a ação do formulário como 'login' -matheus -->
                        <input type="hidden" name="acao" value="login">
                        
                        <!-- Campo para o usuário inserir o e-mail -matheus -->
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-control" required id="email" name="email">
                        </div>

                        <!-- Campo para o usuário inserir a senha -matheus -->
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" required id="senha" name="senha">
                        </div>
                        
                        <!-- Botão para submeter o formulário e tentar o login -matheus -->
                        <div class="text-right">
                            <button class="btn btn-success" type="submit">Acessar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Inclui o rodapé da página a partir do arquivo 'rodape.php' -matheus -->
                <?php
                    include 'includes/rodape.php';
                ?>
            </div>
        </div>
    </div>
    <!-- Inclui o JavaScript do Bootstrap para funcionalidades interativas -matheus -->
    <script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
</body>
</html>
