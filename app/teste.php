<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página Exemplo com Sidebar - Bootstrap 3</title>
    
    <!-- Bootstrap 3 CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- Seu CSS personalizado (sidebar) -->
    <link rel="stylesheet" href="../inc/roger.css">

</head>
<body>

    <?php include '../inc/side-bar.php'; ?>

    <div class="conteudo">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>Dashboard</h1>
                    <p>Essa é uma página de exemplo com Bootstrap 3 e espaço reservado para a sidebar.</p>

                    <div class="panel panel-default">
                        <div class="panel-heading">Painel de Exemplo</div>
                        <div class="panel-body">
                            Aqui vai o conteúdo principal da página.
                        </div>
                    </div>

                    <div class="alert alert-info">
                        Você pode colocar qualquer componente do Bootstrap 3 aqui.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>