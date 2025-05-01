const grava_detento = () => {
    const idDetento = $("#id_beneficiario").val();    
    const cpfDetento = $("#cpf_beneficiario").val();    
    const nomeDetento = $("#nome_beneficiario").val();
    const nomeSocial = $("#nome_social").val();
    const dataNascimento = $("#data_nascimento").val();
    const nomePai = $("#nome_pai").val();
    const nomeMae = $("#nome_mae").val();
    //const ftDetento = $("foto_detento").val();

    const formData = new FormData();
    formData.append('idDetento', idDetento);    
    formData.append('cpfDetento', cpfDetento);
    formData.append('nomeDetento', nomeDetento);
    formData.append('dataNascimento', dataNascimento);
    formData.append('nomePai', nomePai);
    formData.append('nomeMae', nomeMae);
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
                    $("#modal_cad_beneficiario").modal("hide");
                    //window.location.reload();
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