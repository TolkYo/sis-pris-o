const grava_detento = () => {
    //const idDetento = $("#id_beneficiario").val();    
    const cpfDetento = $("#cpf_detento").val();    
    const nomeDetento = $("#nome_detento").val();
    //const nomeSocial = $("#nome_social").val();
    const dataNascimento = $("#data_nascimento").val();
    const nomePai = $("#nome_pai").val();
    const nomeMae = $("#nome_mae").val();
    //const ftDetento = $("foto_detento").val();
    const estadoCivil = $("#estado_civil").val();
    const pavilhao = $("#pavilhao").val();
    const cela = $("#cela").val();
    const crime = $("#tipo_crime").val();


    const formData = new FormData();
    //formData.append('idDetento', idDetento);    
    formData.append('cpfDetento', cpfDetento);
    formData.append('nomeDetento', nomeDetento);
    formData.append('dataNascimento', dataNascimento);
    formData.append('nomePai', nomePai);
    formData.append('nomeMae', nomeMae);
    formData.append('estadoCivil', estadoCivil);
    formData.append('pavilhao', pavilhao);
    formData.append('cela', cela);
    formData.append('crime', crime);
    //formData.append('ftDetento', ftDetento);

    $.ajax({
        data: formData,
        url: '../run/grava_detento.php',
        processData: false,
        contentType: false,
        type: 'POST',
        success: (data) => {
            const dados = JSON.parse(data);
            if (dados.retorno === 1) {
                $("#DIV_MSG_CAD_DETENTO_GERAL").html(dados.mensagemSucesso);
                setTimeout(() => {
                    $("#DIV_MSG_CAD_DETENTO_GERAL").html('');
                    $("#modal_cadastra_presidiario").modal("hide");
                    $("#FRM_CAD_PRESIDIARIO").modal('');
                    window.location.reload();
                }, 3000);
            } else {
                $("#DIV_MSG_CAD_DETENTO_GERAL").html(dados.mensagemErro);
                setTimeout(() => {
                    $("#DIV_MSG_CAD_DETENTO_GERAL").html('');
                }, 3000);
            }
        }
    });
}

const chama_modal_edit_detento = (preso) => {    
    $('#id_preso_hidden').val(preso);
    $.post(
        '../run/carrega_detentos.php',
        {
            preso: preso
        },
        function (data) {
            //console.log(data);
            var dados = JSON.parse(data);
            if (dados.retorno == 1) {         
                //console.log(dados.cpf_detento);    
                $('#txt_cpf_detento').val(dados.cpf_detento);
                $("#txt_nome_detento").val(dados.nome_detento);
                $("#txt_data_nascimento").val(dados.data_nascimento);
                $("#txt_estado_civil").val(dados.estado_civil);                
                $("#txt_nome_mae").val(dados.nome_mae);
                $("#txt_pavilhao").val(dados.pavilhao);
                $("#txt_cela").val(dados.cela);
                $("#txt_tipo_crime").val(dados.tipo_crime);
                $("#txt_reincidencia").val(dados.reincidente);
            } else {                
                $("#DIV_MSG_BENEFICIARIO_GERAL").html(dados.msg);

            }


        }
    );   
    $("#modal_edita_presidiario").modal("show");
}

const edita_detento = () => {
    const id_preso = $("#id_preso_hidden").val();    
    const cpfDetento = $("#txt_cpf_detento").val();    
    const nomeDetento = $("#txt_nome_detento").val();
    const dataNascimento = $("#txt_data_nascimento").val();
    const nomeMae = $("#txt_nome_mae").val();
    const reincidente = $("#txt_reincidencia").val();
    const estadoCivil = $("#txt_estado_civil").val();
    const pavilhao = $("#txt_pavilhao").val();
    const cela = $("#txt_cela").val();
    const crime = $("#txt_tipo_crime").val();


    const formData = new FormData();
    formData.append('id_preso', id_preso);    
    formData.append('cpfDetento', cpfDetento);
    formData.append('nomeDetento', nomeDetento);
    formData.append('dataNascimento', dataNascimento);
    formData.append('nomeMae', nomeMae);
    formData.append('reincidente', reincidente);
    formData.append('estadoCivil', estadoCivil);
    formData.append('pavilhao', pavilhao);
    formData.append('cela', cela);
    formData.append('crime', crime);
    //formData.append('ftDetento', ftDetento);

    $.ajax({
        data: formData,
        url: '../run/edita_detento.php',
        processData: false,
        contentType: false,
        type: 'POST',
        success: (data) => {
            const dados = JSON.parse(data);
            if (dados.retorno === 1) {
                $("#DIV_MSG_EDIT_DETENTO_GERAL").html(dados.mensagemSucesso);
                setTimeout(() => {
                    $("#DIV_MSG_EDIT_DETENTO_GERAL").html('');
                    $("#modal_edita_presidiario").modal("hide");
                    $("#FRM_EDIT_PRESIDIARIO").modal('');
                    window.location.reload();
                }, 3000);
            } else {
                $("#DIV_MSG_EDIT_DETENTO_GERAL").html(dados.mensagemErro);
                setTimeout(() => {
                    $("#DIV_MSG_EDIT_DETENTO_GERAL").html('');
                }, 3000);
            }
        }
    });
}

function checa_cadastro(){
    const cpfDetento = $("#cpf_detento").val();

    const formData = new FormData();
    formData.append('cpfDetento', cpfDetento);

    $.ajax({
        data: formData,
        url: '../run/checa_cpf.php',
        processData: false,
        contentType: false,
        type: 'POST',
        success: (data) => {
            const dados = JSON.parse(data);
            if (dados.retorno == 1) {
                $("#DIV_MSG_CAD_DETENTO_GERAL").html(
                    ' <br><img src="../assets/images/ajax-loader.gif" height="30" width="30"> <b>Carregando dados, aguarde... </b><br>.'
                );
                $("#DIV_MSG_CAD_DETENTO_GERAL").html(dados.mensagemSucesso);
                setTimeout(() => {
                    $("#DIV_MSG_CAD_DETENTO_GERAL").html('');                    
                }, 4000);
            } else {
                $("#FRM_EDIT_PRESIDIARIO").trigger("reset");
                $("#DIV_MSG_CAD_DETENTO_GERAL").html(dados.mensagemErro);
                
                $("#modal_cadastra_presidiario").modal("hide");                 
                 $('#id_preso_hidden').val(dados.id_preso);         
                $('#txt_cpf_detento').val(dados.cpf_detento);
                $("#txt_nome_detento").val(dados.nome_detento);
                $("#txt_data_nascimento").val(dados.data_nascimento);
                $("#txt_estado_civil").val(dados.estado_civil);                
                $("#txt_nome_mae").val(dados.nome_mae);
                $("#reincidencia").val(dados.reincidente);
                $("#txt_pavilhao").val(dados.pavilhao);
                $("#txt_cela").val(dados.cela);
                $("#txt_tipo_crime").val(dados.tipo_crime);
                $("#modal_edita_presidiario").modal("show");

                
                
            }
        }
    });
}