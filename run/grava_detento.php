<?php
include '../inc/config.php';
include '../inc/funcoes/funcoes_basicas.php';

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
$compriNomeMae = strlen($nomePai);
$compriNomePai = strlen($nomeMae);

//echo $pavilhao;exit;

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
else{
    $retornoJSON['retorno'] = 1;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-success inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>CPF válido!</b> 
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $processaJSON = json_encode($retornoJSON);
    exit;
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

if (!$estadoCivil) {
    $retornoJSON['retorno'] = 0;
    $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
    <b>Insira o Estado Civil!</b>
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
}else if($compriNomeMae < 7){
    $retornoJSON['retorno'] = 0;
        $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
        <b>O nome da Mãe está muito curto!</b>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        echo $processaJSON = json_encode($retornoJSON);
}else if($nomePai){
    if($compriNomeMae < 7){
        $retornoJSON['retorno'] = 0;
            $retornoJSON['mensagemErro'] = '<div class="alert alert-warning inverse alert-dismissible fade show" role="alert"><i class="fa fa-exclamation-triangle"></i> 
            <b>O nome da Mãe está muito curto!</b>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            echo $processaJSON = json_encode($retornoJSON);
    }
}

/*INSERT INTO usuarios
(nome, email, senha, pde_logar)
VALUES(
'Cláudio Manoel',
'claudio.moliveira2003@gmail.com',
'123456',
'N'
)*/

$sqlP = "
    INSERT INTO presos
    (nome, data_nascimento, filiacao, estacio_civil, cpf, pavilhao, id_infracao, id_cela)
    VALUES(
    '$nomeDetento',
    '$dataNascimento',
    '$nomeMae',
    '$estadoCivil',
    '$cpfDetento',
    '$pavilhao',
    '$numCela',
    '$tpoCrime'
    )
";


