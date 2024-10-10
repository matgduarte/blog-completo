<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial | Projeto para Web com PHP</title>
    <link rel="stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
    <!-- Inclui o arquivo CSS do Bootstrap para estilização da página -matheus -->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Inclui o cabeçalho (topo) da página a partir do arquivo 'topo.php' -matheus -->
                <?php
                    include 'includes/topo.php';
                ?>
            </div>
        </div>
        <div class="row" style="min-height: 500px;">
            <div class="col-md-12">
            <!-- Inclui o menu da página a partir do arquivo 'menu.php' -matheus -->
                <?php
                    include 'includes/menu.php';
                ?>
            </div>
            <div class="col-md-10" style="padding-top: 50px;">
            <!-- Área de conteúdo principal da página -matheus -->
            <div class="card-header">Inicio</div>
                <div class="card-body">
                <!-- Inclui a barra de busca da página a partir do arquivo 'busca.php' -matheus -->
                <?php
                    include 'includes/busca.php';
                ?>

                <?php 
                    // Define o fuso horário como São Paulo -matheus
                    date_default_timezone_set('America/Sao_Paulo');
                    // Inclui funções auxiliares e arquivos de conexão com banco de dados -matheus
                    require_once 'includes/funcoes.php';
                    require_once 'core/conexao_mysql.php';
                    require_once 'core/sql.php';
                    require_once 'core/mysql.php';
                    
                    // Limpa os dados recebidos via GET -matheus
                    foreach($_GET as $indice => $dado){
                        $$indice = limparDados($dado);
                    }

                    // Define a data atual para ser usada na busca -matheus
                    $data_atual = date('Y-m-d H:i:s');

                    // Cria o critério de busca com base na data de postagem -matheus
                    $criterio = [
                        ['data_postagem', '<=', $data_atual]
                    ];

                    // Se houver uma busca por título, adiciona o critério -matheus
                    if(!empty($busca)){
                        $criterio[] = [
                            'AND',
                            'titulo',
                            'like',
                            "%{$busca}%"
                        ];
                    }

                    // Faz a busca no banco de dados por posts que atendem aos critérios -matheus
                    $posts = buscar(
                        'post',
                        [
                            'titulo',
                            'data_postagem',
                            'id',
                            '(select nome
                                from usuario
                                where usuario.id = post.usuario_id) as nome'
                        ],
                        $criterio,
                        'data_postagem DESC'
                    );
                ?>
                <div class="mt-3">
                    <div class="list-group">
                        <!-- Lista todos os posts encontrados com título, autor e data de postagem -matheus -->
                        <?php 
                            foreach($posts as $post):
                                // Formata a data da postagem -matheus
                                $data = date_create($post['data_postagem']);
                                $data = date_format($data, 'd/m/Y H:i:s');
                        ?>
                        <a href="post_detalhe.php?post=<?php echo $post['id']?>" class="list-group-item list-group-item-action">
                            <strong><?php echo $post['titulo']?></strong>
                            [<?php echo $post['nome']?>]
                            <span class="badge badge-dark"><?php echo $data?></span>
                        </a>
                        <!-- Exibe o título, nome do autor e data de postagem do post -matheus -->
                        <?php endforeach; ?>
                    </div>
                </div>
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
    <script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
    <!-- Inclui o arquivo JavaScript do Bootstrap -matheus -->
</body>
</html>
