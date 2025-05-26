<?php

include '../inc/config.php';
include '../inc/funcoes/funcoes_basicas.php';

//$doc = $_POST['doc'];
$cpfDetento = desformataCampos(trim($_POST['cpfDetento']));

    if (!$cpfDetento) {
        $retornoJSON['retorno'] = 0;
        $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
        <b>Informe um CPF</b> ! 
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        echo $processaJSON = json_encode($retornoJSON);
        exit;
    }
    else{
        $sql = "SELECT * FROM presos WHERE cpf = '$cpfDetento'";
    }

$result = mysqli_query($conn, $sql) or die('Erro ao executar a query: ' . mysqli_error($conn));
$numRows = mysqli_num_rows($result);

if ($numRows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $retJson['id_preso'] = $row['id_preso'];
        $retJson['cpf_detento'] = $row['cpf'];
        $retJson['nome_detento'] = $row['nome'];
        $retJson['data_nascimento'] = $row['data_nascimento'];
        $retJson['estado_civil'] = $row['estado_civil'];
        $retJson['nome_mae'] = $row['filiacao'];
        $retJson['pavilhao'] = $row['pavilhao'];
        $retJson['cela'] = $row['id_cela'];
        $retJson['tipo_crime'] = $row['id_infracao'];
        $retJson['reincidente'] = $row['reincidente'];
//echo $retJson['reincidente'];exit
        $retJson['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
        <b>Este Cpf já está cadastrado</b> ! <br>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        $retJson['retorno'] = 0;

        echo $processaJSON = json_encode($retJson);
        exit;
    }
}
else{
    $retornoJSON['retorno'] = 1;
        $retornoJSON['mensagemSucesso'] = '<div class="alert alert-success inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
        <b>Digite os dados do novo Detento</b>! 
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
}