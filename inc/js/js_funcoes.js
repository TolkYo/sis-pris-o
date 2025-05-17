const grava_visitas = () => {  
    const cpfVisita = $("#cpf_visita").val();    
    const nomeVisita = $("#nome_visita").val();
    const grauParentesco = $("#grauParentesco").val();
    const dataNasciVisita = $("#dataNasciVisita").val();
    const nomeDetento = $("#nomeDetento").val();
    const dataVisita = $("#dataVisita").val();


    const formData = new FormData();  
    formData.append('cpfVisita', cpfVisita);
    formData.append('nomeVisita', nomeVisita);
    formData.append('grauParentesco', grauParentesco);
    formData.append('dataNasciVisita', dataNasciVisita);
    formData.append('nomeDetento', nomeDetento);
    formData.append('dataVisita', dataVisita);

    $.ajax({
        data: formData,
        url: '../run/grava_visitas.php',
        processData: false,
        contentType: false,
        type: 'POST',
        success: (data) => {
            const dados = JSON.parse(data);
            if (dados.retorno === 1) {
                $("#DIV_MSG_CAD_VISITAS_GERAL").html(dados.mensagemSucesso);
                setTimeout(() => {
                    $("#DIV_MSG_CAD_VISITAS_GERAL").html('');
                    $("#modal_cadastra_visitas").modal("hide");
                    $("#FRM_CAD_VISITAS").modal('');
                    window.location.reload();
                }, 3000);
            } else {
                $("#DIV_MSG_CAD_VISITAS_GERAL").html(dados.mensagemErro);
                setTimeout(() => {
                    $("#DIV_MSG_CAD_VISITAS_GERAL").html('');
                }, 3000);
            }
        }
    });
}