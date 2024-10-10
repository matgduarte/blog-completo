<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários | Projeto para Web com PHP</title>
    <!-- Inclui o CSS do Bootstrap para estilização da página -matheus -->
    <link rel="stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
                    // Inclui o cabeçalho e valida se o usuário está logado -matheus
                    include 'includes/topo.php';
                    include 'includes/valida_login.php';
                    
                    // Verifica se o usuário logado é um administrador -matheus
                    if($_SESSION['login']['usuario']['adm'] !== 1){
                        // Se não for, redireciona para a página inicial -matheus
                        header('Location: index.php');
                    }
                ?>
            </div>
        </div>
        <div class="row" style="min-height: 500px;">
            <div class="col-md-12">
                <!-- Inclui o menu da página -matheus -->
                <?php include 'includes/menu.php'; ?>
            </div>
            <div class="col-md-10" style="padding-top: 50px;">
                <!-- Cabeçalho do card que lista os usuários -matheus -->
                <div class="card-header">Usuarios</div>
                <div class="card-body">
                    <!-- Inclui o formulário de busca -matheus -->
                    <?php include 'includes/busca.php' ?>
                    
                    <!-- Inclui as funções e conexões necessárias -matheus -->
                    <?php
                        require_once 'includes/funcoes.php';
                        require_once 'core/conexao_mysql.php';
                        require_once 'core/sql.php';
                        require_once 'core/mysql.php';

                        // Limpa os dados recebidos via GET -matheus
                        foreach($_GET as $indice => $dado){
                            $$indice = limparDados($dado);
                        }

                        $data_atual = date('Y-m-d H:i:s');
                        $criterio = [];

                        // Se houver uma busca por nome, adiciona ao critério de consulta -matheus
                        if(!empty($busca)){
                            $criterio[] = ['nome', 'like', "%{$busca}%"];
                        }

                        // Busca os usuários no banco de dados -matheus
                        $result = buscar(
                            'usuario',
                            [
                                'id',
                                'nome',
                                'email',
                                'data_criacao',
                                'ativo',
                                'adm'
                            ],
                            $criterio,
                            'data_criacao DESC, nome ASC' // Ordenação por data de criação e nome -matheus
                        );
                    ?>

                    <!-- Tabela que exibe a lista de usuários -matheus -->
                    <table class="mt-3 table table-bordered table-hover table-striped table-responsive{-sm|-md|-lg|-xl}">
                        <thead>
                            <tr>
                                <td>Nome</td>
                                <td>E-mail</td>
                                <td>Data cadastro</td>
                                <td>Ativo</td>
                                <td>Administrador</td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Itera sobre os usuários retornados e exibe na tabela -matheus -->
                            <?php 
                                foreach($result as $entidade):
                                    // Formata a data de criação do usuário -matheus
                                    $data = date_create($entidade['data_criacao']);
                                    $data = date_format($data, 'd/m/Y H:i:s');
                            ?>
                            <tr>
                                <!-- Exibe os dados do usuário -matheus -->
                                <td><?php echo $entidade['nome'] ?></td>
                                <td><?php echo $entidade['email'] ?></td>
                                <td><?php echo $data ?></td>

                                <!-- Link para ativar/desativar o usuário -matheus -->
                                <td>
                                    <a href='core/usuario_repositorio.php?acao=status&id=<?php echo $entidade['id']?>&valor=<?php echo !$entidade['ativo']?>'>
                                        <?php echo($entidade['ativo']==1) ? 'Desativar' : 'Ativar'; ?>
                                    </a>
                                </td>

                                <!-- Link para promover/rebaixar o usuário a administrador -matheus -->
                                <td>
                                    <a href='core/usuario_repositorio.php?acao=adm&id=<?php echo $entidade['id']?>&valor=<?php echo !$entidade['adm']?>'>
                                        <?php echo ($entidade['adm']==1) ? 'Rebaixar' : 'Promover'; ?>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
