<?php
include '../inc/config.php';
include '../inc/funcoes/funcoes_basicas.php';
include '../inc/modais/modal_cad_visitas.php';
include '../inc/funcoes/funcao.php';

$nome = '';

if (!$nome) {
    $nome = '';
}
//$nomeProd = localizaDados($conn ,'produtos', 'nome', 'id_produto = 1');
//echo $nomeProd;exit;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>...</title>

    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon/favicon.png" type="image/x-icon">
    <title></title>
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link
            href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet">
    <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet">
    <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
            rel="stylesheet">

    <!-- ico-font-->
    <link rel="stylesheet" href="../assets/font-awesome-4/css/font-awesome.min.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/prism.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/calendar.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../inc/roger.css">
    
</head> 
<body>
   <div class="tap-top"><i data-feather="chevrons-up"></i></div>
<div class="loader-wrapper"><div class="loader"></div></div>

<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- por menu top aq  -->
    <div class="page-body-wrapper">
        <div class="sidebar-wrapper">
            <div>
                <?php include '../inc/side-bar.php'; ?>
            </div>
        </div>
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-lg-3">
                            <button id="btn_cad" class="btn btn-dark btn-block" type="button" onclick="chama_modal_cad_visitas();"><i class="fa fa-plus"></i> Cadastrar</button>
                        </div> 
                         <?php echo lista_presos($nome, $conn); ?>
                    </div>
                </div>

                <div class="container-fluid default-page">        
                </div>
            </div>
        </div>

        <footer class="footer">
            <?php include '../inc/rodape.php'; ?>
        </footer>
    </div>
</div>

    
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../assets/js/bootstrap/popper.min.js"></script>
<script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="../inc/js/js_script.js"></script>
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
<script src="../assets/js/scrollbar/simplebar.js"></script>
<script src="../assets/js/scrollbar/custom.js"></script>
<script src="../assets/js/config.js"></script>
<script src="../assets/js/sidebar-menu.js"></script>
<script src="../assets/js/chart/knob/knob.min.js"></script>
<script src="../assets/js/chart/knob/knob-chart.js"></script>
<script src="../assets/js/chart/apex-chart/stock-prices.js"></script>
<script src="../assets/js/prism/prism.min.js"></script>
<script src="../assets/js/clipboard/clipboard.min.js"></script>
<script src="../assets/js/custom-card/custom-card.js"></script><!-- 
<script src="../assets/js/notify/bootstrap-notify.min.js"></script>
<script src="../assets/js/notify/index.js"></script> -->
<script src="../assets/js/typeahead/handlebars.js"></script>
<script src="../assets/js/typeahead/typeahead.bundle.js"></script>
<script src="../assets/js/typeahead/typeahead.custom.js"></script>
<script src="../assets/js/typeahead-search/handlebars.js"></script>
<script src="../assets/js/typeahead-search/typeahead-custom.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../inc/js/js_detentos.js"></script>

<script>
    const chama_modal_cad_visitas = () => {
        $("#modal_cadastra_visitas").modal("show");
    }
</script>
</body>
</html>