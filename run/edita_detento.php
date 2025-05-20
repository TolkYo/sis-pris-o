<?php
include '../inc/config.php';
include '../inc/funcoes/funcoes_basicas.php';

$id_preso = $_POST['id_preso'];
$cpfDetento = desformataCampos(trim($_POST['cpfDetento']));
$nomeDetento = strtoupper(trim($_POST['nomeDetento']));
$dataNascimento = $_POST['dataNascimento'];
$nomePai = strtoupper(trim($_POST['nomePai']));
$nomeMae = strtoupper(trim($_POST['nomeMae']));
$estadoCivil = strtoupper(trim($_POST['estadoCivil']));
$pavilhao = $_POST['pavilhao'];
$numCela = $_POST['cela'];
$tpoCrime = $_POST['crime'];

$compriNomeDet = strlen($nomeDetento);
$compriNomePai = strlen($nomePai);
$compriNomeMae = strlen($nomeMae);

//echo $estadoCivil;exit;

if ($cpfDetento) {
    $cpf = validaCPF($cpfDetento);
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

if (!$nomeDetento) {
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Insira o Nome do Detento!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
}

if (!$dataNascimento) {
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Insira uma Data de Nascimento!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
}


if (!$nomeMae) {
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Insira o nome da Mãe!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
}

if (!$pavilhao) {
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Selecione um Pavilhão!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
}

if (!$numCela) {
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Selecione um numero de Cela!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
}

if (!$tpoCrime) {
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Selecione um tipo de Crime!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
}

if($compriNomeDet < 7){
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>O nome do Beneficiario está muito curto!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
}
if($compriNomeMae < 7){
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>O nome da Mãe está muito curto!</b>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
}
if($nomePai){
    if($compriNomeMae < 7){
        $retornoJSON['retorno'] = 0;
        $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
        <b>O nome do Pai está muito curto!</b>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        echo $processaJSON = json_encode($retornoJSON);
    }
}
//echo $processaJSON = json_encode($retornoJSON);

$sqlP = "
    UPDATE presos SET

    nome = '$nomeDetento',
    data_nascimento = '$dataNascimento',
    filiacao = '$nomeMae',
    estado_civil = '$estadoCivil',
    cpf = '$cpfDetento',
    pavilhao = '$pavilhao',
    reincidente = 'N',
    id_cela = '$numCela',
    id_infracao = '$tpoCrime'
    WHERE id_preso = '$id_preso'
";

//$execute = pg_query($sqlP) or die('Erro ao inserir dados do beneficiário: ' . pg_last_error());
$execute = mysqli_query($conn, $sqlP) or die('Erro ao inserir dados do detento: ' . mysqli_error($conn));
$row = mysqli_fetch_assoc($execute);
$idPreso = $row['id_preso'];

if($idPreso > 0){
    $retornoJSON['retorno'] = 1;
    $retornoJSON['mensagemSucesso'] = '<div class="alert alert-success inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Detento cadastrado com Sucesso!</b>
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
