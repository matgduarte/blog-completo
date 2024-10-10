<!DOCTYPE html>
<?php
    // Inclui as funções e scripts de conexão ao banco de dados e SQL -matheus
    require_once 'includes/funcoes.php';
    require_once 'core/conexao_mysql.php';
    require_once 'core/sql.php';
    require_once 'core/mysql.php';

    // Limpa os dados recebidos via GET e armazena em variáveis dinâmicas -matheus
    foreach($_GET as $indice => $dado){
        $$indice = limparDados($dado);
    }

    // Busca o post específico pelo ID passado via GET -matheus
    $posts = buscar(
        'post',
        [
            'titulo',           // Título do post -matheus
            'data_postagem',    // Data de postagem -matheus
            'texto',            // Conteúdo do post -matheus
            '(select nome
                from usuario
                where usuario.id = post.usuario_id) as nome' // Nome do autor do post -matheus
        ],
        [
            ['id', '=', $post] // Critério de busca: ID do post -matheus
        ]
    );

    // Armazena o primeiro post encontrado (já que o ID é único) -matheus
    $post = $posts[0];

    // Formata a data da postagem para o formato d/m/Y H:i:s -matheus
    $data_post = date_create($post['data_postagem']);
    $data_post = date_format($data_post, 'd/m/Y H:i:s');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Exibe o título do post no título da página -matheus -->
    <title><?php echo $post['titulo']?></title>
    <link rel="stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
    <!-- Inclui o CSS do Bootstrap para estilização da página -matheus -->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Inclui o topo da página a partir do arquivo 'topo.php' -matheus -->
                <?php
                    include 'includes/topo.php';
                ?>
            </div>
        </div>
        <div class="row" style="min-height: 500px;">
            <div class="col-md-12">
                <!-- Inclui o menu da página a partir do arquivo 'menu.php' -matheus -->
                <?php include 'includes/menu.php';?>
            </div>
            <div class="col-md-10" style="padding-top: 50px;">
                <!-- Exibe o conteúdo detalhado do post -matheus -->
                <div class="card-body">
                    <h5 class="card-title"><?php echo $post['titulo'] ?> </h5>
                    <!-- Exibe a data de postagem e o nome do autor -matheus -->
                    <h5 class="card-subtitle mb-2 text-muted"> 
                        <?php echo $data_post ?> Por <?php echo $post['nome'] ?>
                    </h5>
                    <div class="card-text">
                        <!-- Exibe o texto completo do post, decodificado de HTML -matheus -->
                        <?php echo html_entity_decode($post['texto']) ?>
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
    <!-- Inclui o JavaScript do Bootstrap para funcionalidades interativas -matheus -->
    <script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
</body>
</html>
