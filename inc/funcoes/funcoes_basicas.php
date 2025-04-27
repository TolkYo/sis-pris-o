<?php

function dataPorExtenso($data)
{
    $dias = array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");
    $meses = array("", "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

    $dia = date('d', strtotime($data));
    $mes = $meses[date('n', strtotime($data))];
    $ano = date('Y', strtotime($data));

    return $dia . ' de ' . $mes . ' de ' . $ano;
}

function ordenaArray($array, $on, $order = SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

function diferencaEntreDuasDatas($data_inicial, $data_final)
{
    $diferenca = strtotime($data_final) - strtotime($data_inicial);
    $dias = floor($diferenca / (60 * 60 * 24));

    return $dias;
}

function diferencaEntreDuasDatasEmSegundos($data_inicial, $data_final)
{
    $diferenca = strtotime($data_final) - strtotime($data_inicial);

    return $diferenca;
}

function abreviarNomeMeio($nomeCompleto)
{
    $nomes = explode(' ', $nomeCompleto);
    $numPalavras = count($nomes);
    if ($numPalavras < 3) {
        return $nomeCompleto;
    }

    for ($i = 1; $i < $numPalavras - 1; $i++) {
        $nome = $nomes[$i];
        $primeiraLetra = substr($nome, 0, 1);
        $abreviacao = $primeiraLetra . '.';
        $nomes[$i] = $abreviacao;
    }

    return implode(' ', $nomes);
}

function extrairNome($nomeCompleto)
{
    $nomes = explode(" ", $nomeCompleto); // Separa os nomes em um array
    $primeiroNome = $nomes[0]; // Obtém o primeiro nome
    $ultimoNome = end($nomes); // Obtém o último nome
    return $primeiroNome . ' ' . $ultimoNome; // Retorna um array com o primeiro e último nome
}

function abrevia($nome)
{
    $nome = explode(" ", $nome);
    $num = count($nome);
    if ($num == 2) {
        return $nome;
    } else {
        $count = 0;
        $novo_nome = '';
        foreach ($nome as $var) {
            if ($count == 0) {
                $novo_nome .= $var . ' ';
            }
            $count++;
            if (($count >= 2) && ($count < $num)) {
                $array = array('do', 'Do', 'DO', 'da', 'Da', 'DA', 'de', 'De', 'DE', 'dos', 'Dos', 'DOS', 'das', 'Das', 'DAS');
                if (in_array($var, $array)) {
                    $novo_nome .= $var . ' ';
                } else {
                    $novo_nome .= substr($var, 0, 1) . 'inc '; // abreviou
                }
            }

            if ($count == $num) {
                $novo_nome .= $var;
            }
        }

        return $novo_nome;

    }


}

function enviarEmail($destinatarios, $assuntoMail, $mensagemMail, $anexoArquivo)
{
    $explodeDestinatarios = explode(";", $destinatarios);
    $totDestinatarios = sizeof($explodeDestinatarios);

    for ($i = 0; $i <= $totDestinatarios; $i++) {
        //separa os campos para Analise
        $destinatarioMail = $explodeDestinatarios[$i];
        if (strlen($destinatarioMail) > 4) {
            $statusEnvio = mailer($destinatarioMail, $assuntoMail, $mensagemMail, $anexoArquivo);

            if ($statusEnvio == 0) {
                $erroEnviando++;
                //echo "Erro enviando Email para $destinatarioMail<BR>";
            } else {
                $sucessoEnviando++;
                //echo "Enviado para: $destinatarioMail;<BR>";

            }

            //echo "Enviado para: $destinatarioMail;<BR>";
        }
    }

    if ($erroEnviando > 0) {
        //  echo "Ocorreram $erroEnviando erros no envio do Email. Por favor Verifique<BR>";
    }
    return $erroEnviando;

}

function mailer($mailDestino, $assuntoMail, $mensagemMail, $anexoArquivo)
{
    header('Content-Type: text/html; charset=UTF-8');
    //error_reporting(E_ALL);
    //error_reporting(E_STRICT);

    date_default_timezone_set('America/Manaus');
    //date_default_timezone_set("Brazil/East");

    include_once '../php_mailer/src/PHPMailerAutoload.php';

    $assuntoMail = utf8_decode($assuntoMail);
    $mensagemMail = utf8_decode($mensagemMail);

    $mail = new \PHPMailer();

    $body = "$mensagemMail";                //file_get_contents('contents.html');
    $body = eregi_replace("[\]", '', $body);


    $mail->IsSMTP();                                    // telling the class to use SMTP
    $mail->Host = "smtp.office365.com";           // SMTP server
    $mail->SMTPDebug = "0";                            // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth = true;                           // enable SMTP authentication

    $mail->SMTPSecure = 'tls';                        // SSL REQUERIDO pelo GMail
    $mail->Host = "smtp.office365.com";        // sets the SMTP server
    $mail->Port = 587;                            // set the SMTP port for the GMAIL server (587)
    $mail->Username = "nis@saude.am.gov.br";        // SMTP account username
    $mail->Password = "s3s_@sd1g1t@l";                // SMTP account password

    $mail->SetFrom('nis@saude.am.gov.br', 'SES-AM - Secretaria de Estado de Saúde do Amazonas');

    $mail->AddReplyTo("nis@saude.am.gov.br", "SES-AM - Secretaria de Estado de Saúde do Amazonas");

    $mail->Subject = "$assuntoMail";

    $mail->AltBody = "";                            // optional, comment out and test

    $mail->MsgHTML($body);

    $address = "$mailDestino";
    $mail->AddAddress($address, "SES-AM - Secretaria de Estado de Saúde do Amazonas");

    if ($anexoArquivo) {
        $mail->AddAttachment($anexoArquivo);            // attachment
    }

    if (!$mail->Send()) {
        return $mail->ErrorInfo;                        //erro
    } else {
        return 1;
    }
}

function downloadArquivoInterface($pasta, $nomeArquivo)
{
    $nomeDoArquivoLink = substr($nomeArquivo, 0, 30) . "...";
    return '    
            <a href="../inc/download.php?arquivo=' . $nomeArquivo . '&pasta=' . $pasta . '">
            <img src="../img/credit_card.png"  border="0" > <b>' . $nomeDoArquivoLink . '</b> </a> 
    ';
}

function dataDoProximoSabado()
{
    $week_day = date("w");
    $weekend = 6; // sabado

    // Verifica quantos dias faltam para o fim de semana (sabado) proximo
    $diff = $weekend - $week_day;

    // Obtem dia do proximo sabado
    $weekend_day['saturday'] = date("d/m/Y", mktime(0, 0, 0, date("m"), (date("d") + $diff), date("Y")));
    $weekend_day['sunday'] = date("d/m/Y", mktime(0, 0, 0, date("m"), (date("d") + $diff + 1), date("Y")));

    /*echo "Fim de semana da semana:<br />";
    echo "Sábado: ".$weekend_day['saturday'];
    echo "<br />";
    echo "Domingo: ".$weekend_day['sunday'];*/

    $dataProxSabado = $weekend_day['saturday'];

    return $dataProxSabado;

}

function ultimoDiaMes($mes, $ano)
{

    $ultimo_dia = date("t", mktime(0, 0, 0, $mes, '01', $ano));
    return $ultimo_dia;
}

function ultimoRegistro($tabela, $campo, $creterio)
{
    //contas os itens em um pedido aberto (ainda pendente de confirmação)

    $sqlItensCarrinho = "SELECT MAX($campo) AS max FROM $tabela 
	WHERE 
	$creterio ";
    $rsqlItensCarrinho = pg_query($sqlItensCarrinho) or die ("erro contando itens $sqlItensCarrinho");
    if ($lsqlItensCarrinho = pg_fetch_array($rsqlItensCarrinho)) {
        $totItens = $lsqlItensCarrinho['max'];
    } else {
        $totItens = 0;
    }
    return $totItens;

}

function descStatus($idStatus)
{
    $descStatus = localizaDados("status", "desc_status", "id_status = '$idStatus'");
    $corEtiqueta = localizaDados("status", "cor_bandeira", "id_status = '$idStatus'");
    $ico = localizaDados("status", "ico", "id_status = '$idStatus'");
    $status = '<div class="badge badge-' . $corEtiqueta . ' label-square">' . $ico . ' <span class="f-14">' . $descStatus . '</span></div>';

    return $status;

}

function desc_status_botao($idStatus)
{
    $descStatus = localizaDados("cad_status", "nome_status", "id_status = '$idStatus'");
    $corEtiqueta = localizaDados("cad_status", "cor_band", "id_status = '$idStatus'");
    $ico = localizaDados("cad_status", "ico", "id_status = '$idStatus'");
    $status = '<button class="btn btn btn-' . $corEtiqueta . '" type="button">' . $ico . ' ' . $descStatus . '</button> </span>';
    return $status;

}

function nomeDoMes($x)
{

    $mes[1] = "Janeiro";
    $mes[2] = "Fevereiro";
    $mes[3] = "Março";
    $mes[4] = "Abril";
    $mes[5] = "Maio";
    $mes[6] = "Junho";
    $mes[7] = "Julho";
    $mes[8] = "Agosto";
    $mes[9] = "Setembro";
    $mes[10] = "Outubro";
    $mes[11] = "Novembro";
    $mes[12] = "Dezembro";

    return $mes[$x];
}

function nomeDoMes2($x)
{

    $mes['01'] = "Janeiro";
    $mes['02'] = "Fevereiro";
    $mes['03'] = "Março";
    $mes['04'] = "Abril";
    $mes['05'] = "Maio";
    $mes['06'] = "Junho";
    $mes['07'] = "Julho";
    $mes['08'] = "Agosto";
    $mes['09'] = "Setembro";
    $mes['10'] = "Outubro";
    $mes['11'] = "Novembro";
    $mes['12'] = "Dezembro";

    return $mes[$x];
}

function nomeDoMesAbrev($x)
{

    $mes[1] = "Jan";
    $mes[2] = "Fev";
    $mes[3] = "Mar";
    $mes[4] = "Abr";
    $mes[5] = "Mai";
    $mes[6] = "Jun";
    $mes[7] = "Jul";
    $mes[8] = "Ago";
    $mes[9] = "Set";
    $mes[10] = "Out";
    $mes[11] = "Nov";
    $mes[12] = "Dez";

    return $mes[$x];
}

//soma dias
function somaDiasData($data, $dias) //formato(Y-m-d)
{
    $diasS = "+" . $dias . " days";
    return date('Y-m-d', strtotime($diasS, strtotime($data)));
}


function dataExpira($mesesValidade)
{
    $diasExpirar = $mesesValidade * 30;

    $data = date('Y-m-d');
    $dataExpira = somaDiasData($data, $diasExpirar);
    return $dataExpira;
}


function isFimDeSemana($date) {
    return (date('N', strtotime($date)) >= 6);
}

function isFeriado($data){
    $feriado = localizaDados("feriados", "id_feriado", "data='$data'");
    if($feriado > 0){
        return 'S';
    }
    else{
        return 'N';
    }


}
function dia_semana($dia){
    $dia_semana[0] = 'Domingo';
    $dia_semana[1] = 'Segunda-Feira';
    $dia_semana[2] = 'Terça-Feira';
    $dia_semana[3] = 'Quarta-Feira';
    $dia_semana[4] = 'Quinta-Feira';
    $dia_semana[5] = 'Sexta-Feira';
    $dia_semana[6] = 'Sábado';

    return $dia_semana["$dia"];
}


function carrega_feriados_nacionais($ano){

    $url = 'https://brasilapi.com.br/api/feriados/v1/'.$ano;
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_HTTPHEADER => [
            "User-Agent: insomnia/2023.5.8"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $array_feriados = json_decode($response);
    //grava o resultado no banco
    foreach ($array_feriados as $feriado){
        $data_feriado = $feriado->date;
        $nome_feriado = $feriado->name;
        $tipo_feriado = $feriado->type;

        $sql = "INSERT INTO feriados VALUES(
		nextval('feriados_id_feriado_seq'::regclass),
		'$data_feriado',
		'$nome_feriado',
		'$tipo_feriado',
		'$ano'
		)";
        $rsql = pg_query($sql) or die (pg_last_error());

        echo "$data_feriado - $nome_feriado - $tipo_feriado \n";

    }



}

function somaRegistros($tabela, $campo, $creterio)
{
    //contas os itens em um pedido aberto (ainda pendente de confirmação)

    $sqlItensCarrinho = "SELECT SUM($campo) AS totReg FROM $tabela 
	WHERE 
	$creterio ";
    $rsqlItensCarrinho = pg_query($sqlItensCarrinho) or die ("erro contando itens $sqlItensCarrinho");
    if ($lsqlItensCarrinho = pg_fetch_array($rsqlItensCarrinho)) {
        $totItens = $lsqlItensCarrinho['totReg'];
    } else {
        $totItens = 0;
    }
    return $totItens;

}


function contaRegistros($tabela, $campo, $creterio)
{
    //contas os itens em um pedido aberto (ainda pendente de confirmação)

    $sqlItensCarrinho = "SELECT COUNT($campo) AS totReg FROM $tabela 
	WHERE 
	$creterio ";
    $rsqlItensCarrinho = pg_query($sqlItensCarrinho) or die ("erro contando itens $sqlItensCarrinho");
    if ($lsqlItensCarrinho = pg_fetch_array($rsqlItensCarrinho)) {
        $totItens = $lsqlItensCarrinho['totReg'];
    } else {
        $totItens = 0;
    }
    return $totItens;

}

function cadUsuario($perfil, $nomeUser, $email, $distribuidor, $operadora, $cliente, $cpf)
{

    $tabelaUser = localizaDados("perfil_usuario", "tabelaUser", "idPerfil='$perfil'");
    $senha = "CONVENIO";//geraLocalizador(6);
    $senhaSH1 = sha1($senha);
    $sql = "INSERT INTO logins VALUES('0','$email','$senhaSH1','10','$nomeUser','$perfil','','S')";
    $rsql = pg_query($sql) or die (pg_last_error());
    $idLogin = pg_last_oid($rsql);
    if ($idLogin > 0) {

        //grava dados do Usuario
        if ($tabelaUser == "user_distribuidor") {
            $sqlUser = "INSERT INTO $tabelaUser VALUES('0','$idLogin','$distribuidor','$nomeUser','$cpf','0000-00-00','','10')";
        } elseif ($tabelaUser == "user_operadora") {
            $sqlUser = "INSERT INTO $tabelaUser VALUES('0','$idLogin','$operadora','$nomeUser','$cpf','0000-00-00','','10')";
        } elseif ($tabelaUser == "user_cliente") {
            $sqlUser = "INSERT INTO $tabelaUser VALUES('0','$idLogin','$cliente','$nomeUser','$cpf','0000-00-00','','10')";
        }

        $rsqlUser = pg_query($sqlUser) or die (pg_last_error());
        $idUserNew = mysql_insert_id();
        if ($idUserNew > 0) {
            return $idLogin;
        } else {
            return "ERRO";
        }
    } else {
        return "ERRO";
    }

}

function geraLocalizador($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
    $lmin = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%*-';
    $retorno = '';
    $caracteres = '';
    $caracteres .= $lmin;
    if ($maiusculas) $caracteres .= $lmai;
    if ($numeros) $caracteres .= $num;
    if ($simbolos) $caracteres .= $simb;
    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
        $rand = mt_rand(1, $len);
        $retorno .= $caracteres[$rand - 1];
    }
    return $retorno;

}


function validaCNPJ($cnpj)
{

    if (strlen($cnpj) <> 14)
        return false;

    $soma = 0;

    $soma += ($cnpj[0] * 5);
    $soma += ($cnpj[1] * 4);
    $soma += ($cnpj[2] * 3);
    $soma += ($cnpj[3] * 2);
    $soma += ($cnpj[4] * 9);
    $soma += ($cnpj[5] * 8);
    $soma += ($cnpj[6] * 7);
    $soma += ($cnpj[7] * 6);
    $soma += ($cnpj[8] * 5);
    $soma += ($cnpj[9] * 4);
    $soma += ($cnpj[10] * 3);
    $soma += ($cnpj[11] * 2);

    $d1 = $soma % 11;
    $d1 = $d1 < 2 ? 0 : 11 - $d1;

    $soma = 0;
    $soma += ($cnpj[0] * 6);
    $soma += ($cnpj[1] * 5);
    $soma += ($cnpj[2] * 4);
    $soma += ($cnpj[3] * 3);
    $soma += ($cnpj[4] * 2);
    $soma += ($cnpj[5] * 9);
    $soma += ($cnpj[6] * 8);
    $soma += ($cnpj[7] * 7);
    $soma += ($cnpj[8] * 6);
    $soma += ($cnpj[9] * 5);
    $soma += ($cnpj[10] * 4);
    $soma += ($cnpj[11] * 3);
    $soma += ($cnpj[12] * 2);

    $d2 = $soma % 11;
    $d2 = $d2 < 2 ? 0 : 11 - $d2;

    if ($cnpj[12] == $d1 && $cnpj[13] == $d2) {
        return 0; //Valido
    } else {
        return 1; //Invalido
    }
}


function validaCPF($cpf)
{    // Verifiva se o número digitado contém todos os digitos
    $cpf = str_pad(preg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);

    // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
        return 1; //invalido
    } else {   // Calcula os números para verificar se o CPF é verdadeiro
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf{$c} != $d) {
                return 1;  //invalido
            }
        }

        return 0; //valido
    }

    // 1 invalido 0 valido
}

/*
function validaEmail($email)
{
    $conta = "^[a-zA-Z0-9\._-]+@";
    $domino = "[a-zA-Z0-9\._-]+.";
    $extensao = "([a-zA-Z]{2,4})$";
    $pattern = $conta . $domino . $extensao;
    if (preg_match($pattern, $email)) {
        return 0; //Valido
    } else {
        return 1;  //invalido
    }
}
*/
function ValidaEmail($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){ 
        return 0;
    }else{
        return 1;
    }
}


function formataTelefone($fone)
{
    $ddd = substr($fone, 0, 2);
    $numFone = substr($fone, 2, 9);
    if (strlen($numFone) > 8) {
        $foneformatado = "(" . $ddd . ") " . substr($numFone, 0, 5) . "-" . substr($numFone, 5, 4);
    } else {
        $foneformatado = "(" . $ddd . ") " . substr($numFone, 0, 4) . "-" . substr($numFone, 4, 4);
    }

    return $foneformatado;
}

function formataNumeroQtde($numero)
{
    $num_formatado = number_format($numero, 0, '', '.');
    return $num_formatado;
}

function formataNumero($numero)
{
    $num_formatado = number_format($numero, 3, ',', '.');
    return $num_formatado;
}


function formataNumero2Casas($numero)
{
    $num_formatado = number_format($numero, 2, ',', '.');
    return $num_formatado;
}

function formataNumeroMoeda2Casas($numero)
{
    $num_formatado = number_format($numero, 2, ',', '.');
    $num_formatado = "R$ " . $num_formatado;
    return $num_formatado;
}

function formataNumeroMoeda($numero)
{
    $num_formatado = number_format($numero, 3, ',', '.');
    $num_formatado = "R$ " . $num_formatado;
    return $num_formatado;
}

function localizaDados($conn, $tabela, $camporetorno, $criterio)
{
    $sql = "SELECT $camporetorno FROM $tabela WHERE $criterio";
    $rsql = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $l = mysqli_fetch_assoc($rsql);
    return $l[$camporetorno];
}

function localizaDadosCustomizado($tabela, $infoLocalizar, $camporetorno, $criterio)
{
    $sql = "select $infoLocalizar from $tabela where $criterio";
    $rsql = pg_query($sql) or die (pg_last_error());
    $l = pg_fetch_array($rsql);
    //echo $l["$camporetorno"];
    return $l["$camporetorno"];
}

function atualizaDados($tabela, $campoAtualizar, $dadoAtualizar, $campoCriterio, $criterio)
{
    $sql = "UPDATE $tabela SET
    $campoAtualizar    = '$dadoAtualizar'
    WHERE
    $campoCriterio  = '$criterio'";
    $rsql = pg_query($sql) or die (pg_last_error());

    return pg_affected_rows($rsql);
}

function atualizaDadosCriterioLongo($tabela, $campoAtualizar, $dadoAtualizar, $criterio)
{
    $sql = "UPDATE $tabela SET
    $campoAtualizar    = '$dadoAtualizar'
    WHERE $criterio";
    $rsql = pg_query($sql) or die (pg_last_error());

    return pg_affected_rows($rsql);
}

function atualizaDadosCriterioLongoVariosCampos($tabela, $camposAtualizar, $criterio)
{
    $sql = "UPDATE $tabela SET
    $camposAtualizar
    WHERE $criterio";
    $rsql = pg_query($sql) or die ("atualizaDadosCriterioLongoVariosCampos<BR>$sql<br>" . pg_last_error());

    return pg_affected_rows($rsql);
}

function formataCNPJ($cnpj)
{
    if ($cnpj) {
        $cnpj = substr($cnpj, 0, 2) . substr($cnpj, 2, 3) . "." . substr($cnpj, 5, 3) . "/" . substr($cnpj, 8, 4) . "-" . substr($cnpj, 12, 2);
    } else {
        $cnpj = "";
    }
    return $cnpj;
}

function formataCPF($cpf)
{
    if ($cpf) {
        $cpf = substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, 9, 2);
    } else {
        $cpf = "";
    }
    return $cpf;
}

function formataPlaca($placa)
{
    if ($placa) {
        $placa = substr($placa, 0, 3) . "-" . substr($placa, 3, 4);
    } else {
        $placa = "";
    }
    return $placa;
}

function formataCEP($cep)
{
    if ($cep) {
        $cep = substr($cep, 0, 2) . "inc" . substr($cep, 2, 3) . "-" . substr($cep, 5, 3);
    } else {
        $cep = "";
    }
    return $cep;
}

function formataCEPTradicional($cep)
{
    if ($cep) {
        $cep = substr($cep, 0, 2) . substr($cep, 2, 3) . "-" . substr($cep, 5, 3);
    } else {
        $cep = "";
    }
    return $cep;
}

function formata_data($predata)
{

    $data = substr($predata, 6, 4) . "-" . substr($predata, 3, 2) . "-" . substr($predata, 0, 2);
    if ($predata) {
        return $data;
    } else {
        return "";
    }
}

function formata_dataDB($predata1)
{
    if ($predata1 != "0000-00-00") {
        $data = substr($predata1, 8, 2) . "/" . substr($predata1, 5, 2) . "/" . substr($predata1, 0, 4);
        if ($predata1) {
            return $data;
        } else {
            return "";
        }
    }
}

function desformataCampos($campo)
{
    $campo = str_replace(".", "", $campo);
    $campo = str_replace("-", "", $campo);
    $campo = str_replace("/", "", $campo);
    $campo = str_replace("(", "", $campo);
    $campo = str_replace(")", "", $campo);
    $campo = str_replace(" ", "", $campo);


    return $campo;
}

function desformataValor($campo)
{
    $campo = str_replace(",", "-", $campo);
    $campo = str_replace(".", "", $campo);
    $campo = str_replace("-", ".", $campo);
    //die($campo);
    return $campo;
}

function retiraAcentos($string)
{
    $conversao = array('á' => 'a', 'à' => 'a', 'ã' => 'a', 'â' => 'a', 'é' => 'e',
        'ê' => 'e', 'í' => 'i', 'ï' => 'i', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', "ö" => "o",
        'ú' => 'u', 'ü' => 'u', 'ç' => 'c', 'ñ' => 'n', 'Á' => 'A', 'À' => 'A', 'Ã' => 'A',
        'Â' => 'A', 'É' => 'E', 'Ê' => 'E', 'Í' => 'I', 'Ï' => 'I', "Ö" => "O", 'Ó' => 'O',
        'Ô' => 'O', 'Õ' => 'O', 'Ú' => 'U', 'Ü' => 'U', 'Ç' => 'C', 'Ñ' => 'N', '(' => '', ')' => '', "'" => '');
    $novaString = strtr($string, $conversao);

    return $novaString;

}

function drop_status($aplicaEm)
{
    $aplicaEm = strtoupper($aplicaEm);
    
    $sqlQuery = "SELECT * FROM status WHERE aplica_em = 'BENEFICIARIO' ORDER BY desc_status ASC";
    $resultset = pg_query($sqlQuery) or die('Erro ao consultar status: '.$id_beneficiario.'<br>' . pg_last_error());;
    $numRows = pg_num_rows($resultset);
    if (!$numRows) {
        
    }
    else{
        while ($l = pg_fetch_array($resultset)) {
            $id_status = $l['id_status'];
            $nome_status = strtoupper(retiraAcentos($l['desc_status']));
    
            $linha = '<option value="' . $id_status . '"><b>' . $nome_status . '</b></option>';
            $select .= $linha;
        }
    }

    

    // Default option
    $linha1 = '<option value="0"><b>Selecione Status... </b></option>';

    return $linha1 . $select;
}

function drop_tipo_perfil()
{
    
    $sqlQuery = "SELECT * FROM tipo_perfis ORDER BY id_perfil ASC";
    $resultset = pg_query($sqlQuery) or die('Erro ao consultar gênero: ' . id_perfil . '<br>' . pg_last_error());;
    $numRows = pg_num_rows($resultset);
    if (!$numRows) {
        
    }
    else{
        while ($l = pg_fetch_array($resultset)) {
            $id_perfil = $l['id_perfil'];
            $tipo_perfil = strtoupper(retiraAcentos($l['descricao']));
    
            $linha = '<option value="' . $id_perfil . '"><b>' . $tipo_perfil . '</b></option>';
            $select .= $linha;
        }
    }

    

    // Default option
    $linha1 = '<option value="0"><b>Selecione o Tipo de Perfil... </b></option>';

    return $linha1 . $select;
}

function drop_sexo()
{
    
    $sqlQuery = "SELECT * FROM genero WHERE (desc_genero = 'Masculino' OR desc_genero = 'Feminino') ORDER BY desc_genero ASC";
    $resultset = pg_query($sqlQuery) or die('Erro ao consultar gênero: '.$id_genero.'<br>' . pg_last_error());;
    $numRows = pg_num_rows($resultset);
    if (!$numRows) {
        
    }
    else{
        while ($l = pg_fetch_array($resultset)) {
            $id_genero = $l['id_genero'];
            $nome_genero = strtoupper(retiraAcentos($l['desc_genero']));
    
            $linha = '<option value="' . $nome_genero . '"><b>' . $nome_genero . '</b></option>';
            $select .= $linha;
        }
    }

    

    // Default option
    $linha1 = '<option value="0"><b>Selecione Status... </b></option>';

    return $linha1 . $select;
}

function drop_genero()
{
    
    $sqlQuery = "SELECT * FROM genero ORDER BY desc_genero ASC";
    $resultset = pg_query($sqlQuery) or die('Erro ao consultar gênero: '.$id_genero.'<br>' . pg_last_error());;
    $numRows = pg_num_rows($resultset);
    if (!$numRows) {
        
    }
    else{
        while ($l = pg_fetch_array($resultset)) {
            $id_genero = $l['id_genero'];
            $nome_genero = strtoupper(retiraAcentos($l['desc_genero']));
    
            $linha = '<option value="' . $id_genero . '"><b>' . $nome_genero . '</b></option>';
            $select .= $linha;
        }
    }

    

    // Default option
    $linha1 = '<option value="0"><b>Selecione Status... </b></option>';

    return $linha1 . $select;
}

function validaCns($cns)
{
    // VALIDA A SOMA DO PIS
    $pis = substr($cns, 0, 11);
    $soma = 0;

    for ($i = 0, $j = strlen($pis), $k = 15; $i < $j; $i++, $k--) :
        $soma += $pis[$i] * $k;
    endfor;

    $dv = 11 - fmod($soma, 11);
    $dv = ($dv != 11) ? $dv : '0'; // retorna '0' se for igual a 11

    if ($dv == 10) {
        $soma += 2;
        $dv = 11 - fmod($soma, 11);
        $resultado = $pis . '001' . $dv;
    } else {
        $resultado = $pis . '000' . $dv;
    }

    if ($cns != $resultado) {
        return false;
    } else {
        return true;
    }
}

function validaCnsProvisorio($cns)
{
    $soma = 0;

    for ($i = 0, $j = strlen($cns), $k = $j; $i < $j; $i++, $k--) :
        $soma += $cns[$i] * $k;
    endfor;

    return $soma % 11 == 0 && $j == 15;
}

function validaCartaoNacionalSaude($cns)
{

    //  LIMPO A MASCARA SE HOUVER
    $cns = preg_replace('/[^0-9]/', '', (string) $cns);

    //  VALIDA A QUANTIDADE DE NUMEROS
    if (strlen($cns) != 15) {
        return false;
    }

    // VALIDA SE HÁ REPETIÇÃO DE NÚMEROS
    $invalidos = [
        '000000000000000',
        '111111111111111',
        '222222222222222',
        '333333333333333',
        '444444444444444',
        '555555555555555',
        '666666666666666',
        '777777777777777',
        '888888888888888',
        '999999999999999'
    ];

    if (in_array($cns, $invalidos)) {
        return false;
    }

    // VALIDA A SOMA DO PIS
    $acao = substr($cns, 0, 1);

    switch ($acao):
        case '1':
        case '2':
            $ret = validaCns($cns);
            break;
        case '7':
            $ret = validaCnsProvisorio($cns);
            break;
        case '8':
            $ret = validaCnsProvisorio($cns);
            break;
        case '9':
            $ret = validaCnsProvisorio($cns);
            break;
        default:
            $ret = false;
    endswitch;

    return $ret;
}