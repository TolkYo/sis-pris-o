<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Side-Bar</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css-matheus/sidebar.css">

  </head>
  <body>
<div class="wrapper">
  <!-- Sidebar Holder -->
  <nav id="sidebar">
    <div class="sidebar-header">
      <h3>Sistema Presidiario</h3>
      
    </div>

    <ul class="list-unstyled components">
      <li class="active">
        <a href="../app/home.php">Dashboard</a>
      </li>
      <li>
        <a href="#">Cadastro</a>
        <a href="#">Visitas</a>
        <a href="#">Relatorios</a>
        <hide href="#"></>
      </li>  
    </ul>

    <ul class="list-unstyled CTAs">
      <li><a href="../login.php" class="article">Logout</a></li>
    </ul>
  </nav>

  <!-- Page Content Holder -->
  <div id="content">
          <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
            <i class="glyphicon glyphicon-align-left"></i>
          </button>
          <!--Conteudo fica aqui(eu acho)-->
  </div>
</div>
    <script src="../inc/js/js_sidebar.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  </body>
</html>