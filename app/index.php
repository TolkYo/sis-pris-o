<?php
include '../inc/config.php';

$nav = $_GET['nav'];

if ($nav == 0) {
    echo "
        <script>
            window.location.replace('../login.php');
        </script>
    ";
}elseif($nav == 1){
    include 'home.php';
}elseif($nav == 2){
    include 'detentos-cad.php';
}elseif($nav == 3){
    include 'visitas.php';
}