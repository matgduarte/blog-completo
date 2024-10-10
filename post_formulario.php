<!DOCTYPE html>
<html>
    <head>
        <title>Post | Projeto para Web com PHP</title>
        <!-- Inclui o CSS do Bootstrap para estilização da página -matheus -->
        <link rel="stylesheet" 
            href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Inclui o topo da página e valida se o usuário está logado -matheus -->
                    <?php
                        include 'includes/topo.php';
                        include 'includes/valida_login.php';
                    ?>
                </div>      
            </div>
            <div class="row" style="min-height: 500px;">
                <div class="col-md-12">
                    <!-- Inclui o menu da página -matheus -->
                    <?php include 'includes/menu.php'; ?>
                </div>
                <div class="col-md-12" style="padding-top: 50px;">
                    <!-- Inclui scripts de funções e conexão ao banco de dados -matheus -->
                    <?php
                        require_once 'includes/funcoes.php';
                        require_once 'core/conexao_mysql.php';
                        require_once 'core/sql.php';
                        require_once 'core/mysql.php';

                        // Limpa os dados recebidos via GET e armazena em variáveis dinâmicas -matheus
                        foreach ($_GET as $indice => $dado) {
                            $$indice = limparDados($dado);
                        }

                        // Verifica se há um ID enviado, se sim, busca os dados do post para edição -matheus
                        if(!empty($id)) {
                            $id = (int)$id;

                            // Define critério de busca: ID do post -matheus
                            $criterio = [
                                ['id', '=', $id]
                            ];
                            
                            // Busca o post no banco de dados com base no ID -matheus
                            $retorno = buscar(
                                'post',
                                ['*'],
                                $criterio
                            );

                            // Armazena os dados do post encontrado -matheus
                            $entidade = $retorno[0];
                        }
                    ?>
                    <!-- Exibe o formulário para criação ou edição do post -matheus -->
                    <div class="card-header">Post</div>
                <div class="card-body">
                    <form method="post" action="core/post_repositorio.php">
                        <!-- Define a ação do formulário: inserção ou atualização -matheus -->
                        <input type="hidden" name="acao"
                            value="<?php echo empty($id) ? 'insert' : 'update' ?>">
                        <!-- Inclui o ID do post se for edição -matheus -->
                        <input type="hidden" name="id"
                            value="<?php echo $entidade['id'] ?? ''?>" >
                        
                        <!-- Campo para o título do post -matheus -->
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input class="form-control" type="text"
                                required id="titulo" name="titulo"
                                value="<?php echo $entidade['titulo'] ?? '' ?>" >
                        </div>

                        <!-- Campo para o texto do post -matheus -->
                        <div class="form-group">
                            <label for="text">Texto</label>
                            <textarea class="form-control" type="text"
                                required id="texto" name="texto" rows="5"><?php echo $entidade['texto'] ?? '' ?></textarea>
                        </div>

                        <!-- Campo para a data e hora de postagem -matheus -->
                        <div class="form-group">
                            <label for="texto">Postar em</label>
                            <?php
                                // Se a data e hora de postagem já existir, separa em data e hora -matheus
                                $data = (!empty($entidade['data_postagem'])) ?
                                    explode(' ', $entidade['data_postagem'])[0] : '';
                                $hora = (!empty($entidade['data_postagem'])) ?
                                    explode(' ', $entidade['data_postagem'])[1] : '';
                            ?>
                            <div class="row">
                                <!-- Campo para a data de postagem -matheus -->
                                <div class="col-md-3">
                                    <input class="form-control" type="date"
                                        required
                                        id="data_postagem"
                                        name="data_postagem"
                                        value="<?php echo $data ?>">
                                </div>
                                <!-- Campo para a hora de postagem -matheus -->
                                <div class="col-md-3">
                                    <input class="form-control" type="time"
                                        required
                                        id="hora_postagem"
                                        name="hora_postagem"
                                        value="<?php echo $hora ?>" >
                                </div>
                            </div>
                        </div>

                        <!-- Botão de envio do formulário -matheus -->
                        <div class="text-right">
                            <button class="btn btn-success" type="submit">Salvar</button>
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
