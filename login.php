<?php
include 'inc/config.php';
include 'inc/funcoes/funcoes_basicas.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="pixelstrap">
    <link rel="icon" href="assets/images/favicon/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon/favicon.png" type="image/x-icon">
    <title><?php echo $nomeAPP; ?></title>
    <!-- Google font-->
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
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/font-awesome.css">


    <!-- ico-font-->
    <link rel="stylesheet" href="assets/font-awesome-4/css/font-awesome.min.css">
    <!-- ico-font-->
    <link rel="stylesheet" href="assets/css/icofont/icofont.css">

    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/prism.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/calendar.css">


    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
</head>
<body>

<div class="loader-wrapper">
    <div class="loader"></div>
</div>
<div class="container-fluid">
    <div class="row">
        <div id="pag_login"><img class="bg-img-cover bg-center" src="imagens/image.png" alt="bg3">
            <div class="login-card">
                    <div>
                        <div class="login-main">
                            
                            <form class="theme-form" id="form_login">
                                <div class="form-group">
                                    <label class="col-form-label">Usuário</label>
                                    <input class="form-control" type="text" id="txt_email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                <label class="col-form-label">Senha</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" id="txt_senha"
                                            placeholder="*********">
                                        <div class="show-hide"><span class="show"></span></div><!---->
                                    </div>
                                </div>
                                <div>
                                    <div id="DIV_MSG_LOGIN"></div>
                                </div>
                                <button id="btn_login" class="btn btn-dark btn-block w-100" onclick="checa_senha_usuario();" type="button">
                                    Acessar
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
        </div>
        
    </div>
</div>

    <!-- latest jquery-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap/popper.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="assets/js/config.js"></script>
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <script src="inc/js/js_script.js"></script>
    <script src="inc/js/js_detentos.js"></script>

    <script>
        const checa_senha_usuario = () => {
            //alert('banana');
            const email = $('#txt_email').val();
            const senha = $('#txt_senha').val();

            const formData = new FormData();
            formData.append('senha', senha);
            formData.append('email', email);

            $.ajax({
                data: formData,
                url: 'run/checa_login.php',
                processData: false,
                contentType: false,
                type: 'POST',
                success: (data) => {
                    const dados = JSON.parse(data);
                    if (dados.retorno === 1) {
                        $("#btn_login").html("hide");
                        $("#DIV_MSG_LOGIN").html(dados.mensagemSucesso);
                        setTimeout(() => {
                            $("#DIV_MSG_LOGIN").html('');                            
                        },
                        reDireciona('app/home.php')
                        , 3000);
                    } else {
                        $("#btn_login").html("hide");
                        $("#DIV_MSG_LOGIN").html(dados.mensagemErro);
                        setTimeout(() => {
                            $("#DIV_MSG_LOGIN").html('');
                        }, 3000);
                        $("#btn_login").html("hide");
                    }
                }
            });
        }
    </script>
</body>


</html>