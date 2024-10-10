<!DOCTYPE html>
<html>
    <head>
        <title>Usuário | Projeto para Web com PHP</title>
        <!-- Inclui o CSS do Bootstrap para estilização da página -matheus -->
        <link rel="stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Inclui o topo da página -matheus -->
                    <?php include 'includes/topo.php'; ?>
                </div>
            </div>
            <div class="row" style="min-height: 500px;">
                <div class="col-md-12">
                    <!-- Inclui o menu da página -matheus -->
                    <?php include 'includes/menu.php'; ?>
                </div>
                <div class="col-md-10" style="padding-top: 50px;">
                    <!-- Inclui as funções e conexões necessárias -matheus -->
                    <?php
                        require_once 'includes/funcoes.php';
                        require_once 'core/conexao_mysql.php';
                        require_once 'core/sql.php';
                        require_once 'core/mysql.php';

                        // Verifica se há um usuário logado (sessão iniciada) -matheus
                        if(isset($_SESSION['login'])){
                            // Armazena o ID do usuário logado -matheus
                            $id = (int) $_SESSION['login'] ['usuario'] ['id'];

                            // Define o critério de busca pelo ID do usuário -matheus
                            $criterio = [
                                ['id', '=', $id]
                            ];

                            // Busca os dados do usuário no banco -matheus
                            $retorno = buscar(
                                'usuario',
                                ['id', 'nome', 'email'],
                                $criterio
                            );

                            // Armazena os dados do usuário retornados do banco -matheus
                            $entidade = $retorno[0];
                        }
                    ?>
                    <!-- Exibe o formulário para criação ou edição do usuário -matheus -->
                    <div class="card-header">Usuarios</div>
                    <div class="card-body">
                    <form method="post" action="core/usuario_repositorio.php">
                        <!-- Define se a ação é inserir ou atualizar com base na existência do ID -matheus -->
                        <input type="hidden" name="acao"
                            value="<?php echo empty($id) ? 'insert' : 'update' ?>">
                        <!-- Campo oculto para armazenar o ID do usuário se for edição -matheus -->
                        <input type="hidden" name="id"
                            value="<?php echo $entidade['id'] ?? '' ?>">
                        
                        <!-- Campo para o nome do usuário -matheus -->
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input class="form-control" type="text"
                                required id="nome" name="nome"
                                value="<?php echo $entidade['nome'] ?? ''?>">
                        </div>

                        <!-- Campo para o e-mail do usuário -matheus -->
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="text"
                            required id="email" name="email"
                            value="<?php echo $entidade['email'] ?? ''?>">
                        </div>

                        <!-- Exibe o campo de senha apenas para novos usuários, não na edição -matheus -->
                        <?php if(!isset($_SESSION['login'])) : ?>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input class="form-control" type="password"
                                required id="senha" name="senha">
                        </div>
                        <?php endif; ?>

                        <!-- Botão para salvar as alterações ou criar um novo usuário -matheus -->
                        <div class="text-right">
                            <button class="btn btn-success"
                                type="submit">Salvar</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Inclui o rodapé da página -matheus -->
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
