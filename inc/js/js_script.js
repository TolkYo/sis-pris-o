function reDireciona(url) {
  $(window.document.location).attr("href", url);
}

/*
function chamaMenuV(){
  var menu = localStorage.getItem("MENU_VERTICAL");
  
  if(menu == 'menu_usuario.php'){
    var menuV =  `
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar">
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="?nav=100">
                    <i data-feather="home"></i>
                    <span>Principal</span>
                  </a>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="?nav=103">
                    <i data-feather="users"></i>
                    <span>Programas</span>
                  </a>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="?nav=108">
                    <i data-feather="map"></i>
                    <span align="right">Unid. Distribuidoras</span>
                  </a>
                </li>
              </ul>
            </div>
          <div class="sidebar-img-section">
              <div class="sidebar-img-content"><img class="img-fluid" src="../assets/images/dashboard/upgrade/2.png" alt=""> <h4>Plataforma de Agendamentos</h4> </div>
          </div>   
          <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div> 
        </nav>    
        `;

        $('#menuV').append(menuV); 
        feather.replace();


  }
  

}
*/


function validaUser() {
  $("#DIV_PainelSenhaLogin").hide();
  $("#div_msg_Login").html(
    '<img src="assets/images/ajax-loader.gif" height="40" width="40"> <b>Por favor, aguarde... </b>'
  );
  var login = $("#txt_credencial").val();
  var senha = $("#txt_senha").val();

    $.post(
      "run/valida_usuario.php",
      {
        login: login,
        senha: senha,
      },
      function (data) {
        var dados = JSON.parse(data);
        if (dados.retorno == 1) {
          localStorage.setItem("tk_cema", dados.token);
          $("#div_msg_Login").html(dados.mensagemSucesso);
          reDireciona(dados.url);
        } else{ 
          $("#div_msg_Login").html(dados.mensagemErro);
          setTimeout(function () {
            $("#div_msg_Login").html('');
            $("#DIV_PainelSenhaLogin").show();
            $("#txt_credencial").val("");
            $("#txt_senha").val("");            
          }, 2000);
        }
      }
    );
}

function validaUserCredenciado() {
  $("#div_msg_LoginC").html(
    '<img src="../../img/spinner.gif" height="40" width="40"> <b>Por favor, aguarde... </b>'
  );
  var estab = $("#loginCodCredenciado").val();
  var login = $("#userLogin").val();
  var senha = $("#userSenha").val();

  $.post(
    "../../run/valida_usuario.php",
    {
      estab: estab,
      login: login,
      senha: senha,
      tpoUsr: "CREDENCIADO",
    },
    function (data) {
      var dados = JSON.parse(data);
      if (dados.retorno == 1) {
        $("#div_msg_LoginC").html("");
        $("#DIV_PainelSenhaLogin").hide();
        reDireciona(dados.url);
      } else {
        $("#DIV_PainelSenhaLogin").show();
        $("#div_msg_LoginC").html(dados.msg);
        setTimeout(function () {
          $("#div_msg_LoginC").html("");
        }, 2000);
      }
    }
  );
}

function chama_modal_cad_usuario() {
  if (grecaptcha.getResponse()) {
    $("#bt_grava_user").show();
    $("#DIV_MSG_CAD_USER").html("");
    $("#FRM_CAD_DADOS_BASICOS").trigger("reset");
    $("#modal_cad_usuario").modal("show");
  } else {
    $("#div_msg_Login").html(
      '<p align = "center"><b>Por favor, confirme que voce não é um robô!</b></p>'
    );
    setTimeout(function () {
      $("#div_msg_Login").html("");
    }, 3000);
  }
}

function cadastra_login() {
  var cpf = $("#txt_cpf_cad_usuario").val();
  var nome_completo = $("#txt_nome_cad_usuario").val();
  var celular = $("#txt_celular_cad_usuario").val();
  var mail = $("#txt_mail_cad_usuario").val();
  var senha1 = $("#txt_senha1_cad_usuario").val();
  var senha2 = $("#txt_senha2_cad_usuario").val();
  var perfil = "4";
  var resp_captcha = grecaptcha.getResponse();

  if (grecaptcha.getResponse()) {
    $("#DIV_MSG_CAD_USER").html(
      '<img src="../../img/spinner.gif" height="40" width="40"> <b>Por favor, aguarde... </b>'
    );
    $("#bt_grava_user").hide();

    $.post(
      "../../run/grava_login.php",
      {
        senha1: senha1,
        senha2: senha2,
        cpf: cpf,
        nome_completo: nome_completo,
        perfil: perfil,
        mail: mail,
        resp_captcha: resp_captcha,
        celular: celular,
      },
      function (data) {
        grecaptcha.reset();
        var dados = JSON.parse(data);
        $("#DIV_MSG_CAD_USER").html(dados.msg);
        if (dados.retorno == 1) {
          $("#DIV_MSG_CAD_USER").html(dados.msg);
        } else {
          $("#bt_grava_user").show();
          setTimeout(function () {
            $("#DIV_MSG_CAD_USER").html("");
          }, 2000);
        }
      }
    );
  } else {
    $("#DIV_MSG_CAD_USER_CAPTCHA").html(
      '<p align = "center" style="color: red"><b>Por favor, confirme que voce não é um robô!</b></p>'
    );
    setTimeout(function () {
      $("#DIV_MSG_CAD_USER_CAPTCHA").html("");
    }, 3000);
  }
}

function uploadSolicitacaoMedica() {
  var autorizacao = $("#idAutorizacao_SolicitacaoMedic_hidden").val();
  $("#div_msg_IncluiSolicitMedicaAutorizacao").html(
    '<img src="../../img/spinner.gif" height="40" width="40"> <b>Por favor, aguarde... </b>'
  );
  var programaProcessa = "../../run/upload_arrquivo.php";
  var data = new FormData();
  data.append("txtFile", $("#fileUploadSolMedica")[0].files[0]);
  data.append("autorizacao", autorizacao);

  $.ajax({
    url: programaProcessa,
    data: data,
    processData: false,
    contentType: false,
    type: "POST",
    success: function (data) {
      var dados = JSON.parse(data);
      if ((dados.retorno = 1)) {
        $("#div_msg_IncluiSolicitMedicaAutorizacao").html(dados.msg);
        listaUploads(dados.autorizacao);

        setTimeout(function () {
          $("#modalIncluiSolicitacaoMedicaAutorizacao").modal("hide");
        }, 2000);
      } else {
        $("#div_msg_IncluiSolicitMedicaAutorizacao").html(dados.msg);
      }
    },
  });
}

function chama_modal_muda_senha(idLogin) {
  $("#idLogin").val(idLogin);
  $("#FRM_MUDA_SENHA").trigger("reset");
  $("#DIV_MSG_MUDA_SENHA").html("");
  $("#modal_muda_senha").modal("show");
}
/*
function chama_modal_calendario(usuario) {
  $("#idLogin").val(usuario);    
  $("#modal_mostra_calendario").modal("show");
}*/

function muda_senha() {
  const senha1 = $("#txt_muda_senha").val();
  const senha2 = $("#txt_muda_senha2").val();
  const idLogin = $("#idLogin").val();
  const token = localStorage.getItem("tk_cema");

  const formData = new FormData();
  formData.append('senha1', senha1);
  formData.append('senha2', senha2);
  formData.append('idLogin', idLogin);
  formData.append('token', token);

  $.ajax({
      data: formData,
      url: '../run/muda_senha.php',
      processData: false,
      contentType: false,
      type: 'POST',
      success: (data) => {
          const dados = JSON.parse(data);
          if (dados.retorno === 1) {
              $("#DIV_MSG_MUDA_SENHA").html(dados.mensagemSucesso);
              setTimeout(() => {
                  $("#DIV_MSG_MUDA_SENHA").html('');
                  $("#modal_muda_senha").modal("hide");
              }, 2000);
          } else {
              $("#DIV_MSG_MUDA_SENHA").html(dados.mensagemErro);
              setTimeout(() => {
                  $("#DIV_MSG_MUDA_SENHA").html('');
              }, 2000);
          }
      }
  });
}

function testa_forca_senha(input_senha, div_msg, botao) {
  var numeros = /([0-9])/;
  var alfabeto = /([a-zA-Z])/;
  var chEspeciais = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;

  if ($("#" + input_senha).val().length < 6) {
    $("#" + div_msg).html(
      '<span style="color:red"> <b><i class="icon-unlock2"></i>   Senha fraca, insira no mínimo 6 caracteres </b></span>'
    );
    $("#" + botao).hide();
  } else {
    if ($("#" + input_senha).val() == "123456") {
      $("#" + div_msg).html(
        '<span style="color:red"> <b><i class="icon-unlock2"></i>   Senha fraca, sequencia numerica </b></span>'
      );
      $("#" + botao).hide();
    } else {
      if ($("#" + input_senha).val() == "1234567") {
        $("#" + div_msg).html(
          '<span style="color:red"> <b><i class="icon-unlock2"></i>   Senha fraca, sequencia numerica </b></span>'
        );
        $("#" + botao).hide();
      } else {
        if ($("#" + input_senha).val() == "12345678") {
          $("#" + div_msg).html(
            '<span style="color:red"> <b><i class="icon-unlock2"></i>   Senha fraca, sequencia numerica </b></span>'
          );
          $("#" + botao).hide();
        } else {
          if ($("#" + input_senha).val() == "123456789") {
            $("#" + div_msg).html(
              '<span style="color:red"> <b><i class="icon-unlock2"></i>   Senha fraca, sequencia numerica </b></span>'
            );
            $("#" + botao).hide();
          } else {
            if ($("#" + input_senha).val() == "1234567890") {
              $("#" + div_msg).html(
                '<span style="color:red"> <b><i class="icon-unlock2"></i>   Senha fraca, sequencia numerica </b></span>'
              );
              $("#" + botao).hide();
            } else {
              if (
                $("#" + input_senha)
                  .val()
                  .match(numeros) &&
                $("#" + input_senha)
                  .val()
                  .match(alfabeto) &&
                $("#" + input_senha)
                  .val()
                  .match(chEspeciais)
              ) {
                $("#" + div_msg).html(
                  ' <span style="color:green"><b><i class="icon-lock4"></i> Senha forte</b></span>'
                );
                $("#" + botao).show();
              } else {
                $("#" + div_msg).html(
                  '<span style="color:orange"><b> <i class="icon-unlock2"></i> Senha média, insira um caracter especial (@,#,$,...) </b></span>'
                );
                $("#" + botao).hide();
              }
            }
          }
        }
      }
    }
  }
}

function logout() {
  localStorage.clear();
  deleteAllCookies();
  reDireciona("../login.php");
}

function validaToken(accessToken) {
  const token = accessToken || undefined;
  const tokenStorage = localStorage.getItem("tkev");
  if (!token) {
    reDireciona("../login.php");
  }

  if (token != tokenStorage) {
    reDireciona("../login.php");
  }
}

function deleteAllCookies() {
  const cookies = document.cookie.split(";");

  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i];
    const eqPos = cookie.indexOf("=");
    const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
  }
}

function callModalUpdatePass(id_user) {
  $("#participante_id").val(id_user);
  $("#modal_update_senha").modal("show");
}

function update_pass() {
  var idUsuario = $("#participante_id").val();
  var senhaAtual = $("#senhaAtual_type").val();
  var novaSenha = $("#senhaNova_type").val();
  var repeteNovaSenha = $("#repeatSenha_type").val();

  $.post(
    "../run/atualiza_senha_usuario.php",
    {
      token: localStorage.getItem("tkev") || null,
      idUsuario: idUsuario,
      senhaAtual: senhaAtual,
      novaSenha: novaSenha,
      repeteNovaSenha: repeteNovaSenha,
    },
    function (data) {
      var dados = JSON.parse(data);
      if (dados.retorno === 1) {
        $("#message_atualiza_senha").html(dados.msg);
        setTimeout(function () {
          $("#message_atualiza_senha").html("");
          $("#alterarSenhaUsuario").trigger(reset);
          $("#modal_update_senha").modal("hide");
        }, 3000);
      } else {
        $("#message_atualiza_senha").html(dados.msg);
        setTimeout(function () {
          $("#message_atualiza_senha").html("");
          $("#alterarSenhaUsuario").trigger(reset);
        }, 3000);
      }
    }
  );
}

function solicita_senha() {
  const email = $("#emailUsuario").val();
  const cpf = $("#cpfUsuario").val()
  $.post(
    "run/solicita_senha.php",
    {
      email: email,
      cpf: cpf,
    },
    function (data) {
      const returnData = JSON.parse(data);
      if (returnData.retorno === 1) {
        $("#div_msg_redefineSenha").html(returnData.msg);
        setTimeout(function () {
          $("#div_msg_redefineSenha").html("");
          document.getElementById("retornaLogin").click();
        }, 3000);
      } else {
        $("#div_msg_redefineSenha").html(returnData.msg);
        setTimeout(function () {
          $("#div_msg_redefineSenha").html("");
        }, 2000);
      }
    }
  );
}
