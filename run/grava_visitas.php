<?php
include '../inc/config.php';
include '../inc/funcoes/funcoes_basicas.php';

$cpfVisita = desformataCampos(trim($_POST['cpfVisita']));
$nomeVisita = strtoupper(trim($_POST['nomeVisita']));
$grauParentesco = strtoupper(trim($_POST['grauParentesco']));
$dataNasciVisita = $_POST['dataNasciVisita'];
$nomeDetento = strtoupper(trim($_POST['nomeDetento']));
$dataVisita = $_POST['dataVisita'];

$compriNomeVis = strlen($nomeVisita);

//echo $estadoCivil;exit;

if ($cpfVisita) {
    $cpf = validaCPF($cpfVisita);
    if($cpf == 1){
        $retornoJSON['retorno'] = 0;
        $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
        <b>Insira um CPF válido!</b>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        echo $processaJSON = json_encode($retornoJSON);
        exit;
    }
}

if (!$nomeVisita) {
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Insira o Nome do Visitante!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
}

if (!$grauParentesco) {
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Insira o Grau de Parentesco!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
}

if (!$dataNasciVisita) {
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Insira a Data da Visita!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
}

if (!$nomeDetento) {
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Insira o nome do Detento!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
}

if (!$dataVisita) {
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Insira a Data da Visita!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
}

if($compriNomeVis < 7){
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Insira o nome do Visitante completo!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
}
//echo $processaJSON = json_encode($retornoJSON);

$sqlV = "
    INSERT INTO visitas
    (nome, grau_parentesco, data_nasci_visita, nome_detento, cpf_visita, data_visita)
    VALUES(    
    '$nomeVisita',
    '$grauParentesco',
    '$dataNasciVisita',
    '$nomeDetento',
    '$cpfVisita',
    '$dataVisita'
    )
    RETURNING id_visita
";

//$execute = pg_query($sqlP) or die('Erro ao inserir dados do beneficiário: ' . pg_last_error());
$execute = mysqli_query($conn, $sqlV) or die('Erro ao inserir dados do detento: ' . mysqli_error($conn));
$row = mysqli_fetch_assoc($execute);
$idVisita = $row['id_visita'];

if($idVisita > 0){
    $retornoJSON['retorno'] = 1;
    $retornoJSON['mensagemSucesso'] = '<div class="alert alert-success inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Visita cadastrada com Sucesso!<br> Seu id de Visita é:</b>'. $idVisita .'
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
}else{
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Erro ao Cadastrar novo Detento!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
}
