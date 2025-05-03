<?php
include '../inc/config.php';
include '../inc/funcoes/funcoes_basicas.php';

$senha = $_POST['senha'];
$email = $_POST['email'];

$senhaBd = localizaDados($conn,'usuarios','senha',"pde_logar = 'S'");
$emailBd = localizaDados($conn,'usuarios','email',"pde_logar = 'S'");
$pdeLogar = localizaDados($conn, 'usuarios','pde_logar',"email = '$email'");
//var_dump($senhaBd);exit;


if($senhaBd == $senha && $emailBd == $email && $pdeLogar == 'S'){ 
    $retornoJSON['retorno'] = 1;
    $retornoJSON['mensagemSucesso'] = '<div class="alert alert-success inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Brabo</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
}else{
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Paia</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
}