<?php

define('DEBUG', false);
//define('DEBUG', true);

set_time_limit(0);
ini_set('post_max_size', '200M');
ini_set('upload_max_filesize', '200M');

if (DEBUG == true) {
    ini_set('display_errors', 'On');
    error_reporting(E_ALL & ~E_NOTICE);
} else {
    ini_set('display_errors', 'Off');
    error_reporting(0);
}

include '../inc/config.php';
include '../inc/funcoes/funcoes_basicas.php';

$id_detento = $_POST['preso'];
//echo $id_detento;exit;

if (!$id_detento) {
    $retorno = 0;
	$msg = '
	<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
		<b>O detento não foi localizado! </b> 
		<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>';
	$retJson['retorno'] = $retorno;
	$retJson['msg'] = $msg;

	echo json_encode($retJson);
	exit;

}else{
    $sqlQuery = "SELECT * FROM presos WHERE id_preso = '$id_detento'";
    
    $result = $conn->query($sqlQuery);
    //echo $sqlQuery;exit;

    if (!$result) {
        die('Erro ao consultar Detento: ' . $id_detento . '<br>' . $mysqli->error);
    }
    
    $numRows = $result->num_rows;
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
        $retJson['retorno'] = 1;

        echo $processaJSON = json_encode($retJson);
        exit;
    }
    } else {
        $msg = '
        <div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
            <b>O Detento não foi localizado!</b> 
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        $retJson['retorno'] = 0;
        $retJson['msg'] = $msg;
        echo $processaJSON = json_encode($retJson);
        exit;
    }
    
   
}

