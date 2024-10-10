<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post | Projeto para Web com PHP</title>
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
                <?php include 'includes/menu.php'; ?>
            </div>
            <div class="col-md-10" style="padding-top: 50px;">
                <!-- Conteúdo de teste da página -matheus -->
                <h2>Pagina teste includes</h2>
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
