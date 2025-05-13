<div class="modal fade" id="modal_cadastra_visitas" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container-fluid default-page">

                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><i class="fa fa-plus fa-fw"></i>Cadastrar Visitas</h4>
                </div>

                <div class="card" style="background-color:Gray;">
                    <div class="card-body">
                        <div id="div_check_cns">
                            <form class="theme-form" id="FRM_CAD_VISITAS">
                                <div class="row">
                                    <div class="col-xl-4"><br>
                                        <label class="col-form-label pt-0"
                                            for="cpf_detento"><b>CPF*</b></label>
                                        <input class="form-control" id="cpf_detento"
                                            type="number" aria-describedby="emailHelps"
                                            placeholder="CPF">
                                    </div>
                                    <div class="col-xl-8"><br>
                                        <label class="col-form-label pt-0"
                                            for="nome_detento"><b>Nome do Visitante*</b> sem abreviação</label>
                                        <input class="form-control" id="nome_detento"
                                            type="text" aria-describedby="emailHelps"
                                            placeholder="Nome completo">
                                    </div>
                                </div>    
                                <div class="row">
                                    <div class="col-xl-6"><br>
                                        <label class="col-form-label pt-0" for="data_nascimento"><b>Grau de Parentesco*</b></label>
                                        <input class="form-control" id="data_nascimento"
                                            type="text" placeholder="Data do Nascimento">
                                    </div>
                                    <div class="col-xl-6"><br>
                                        <label class="col-form-label pt-0"
                                                for="estado_civil"><b>Data da Visita*</b>
                                        </label>
                                        <input class="form-control" id="estado_civil"
                                            type="date" aria-describedby="emailHelps" placeholder="Estado Civil">
                                    </div>                                                                                                                                                                                         
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="row">
                            <div class="col-md-10 text-start">
                                <div id="DIV_MSG_CAD_DETENTO_GERAL"></div>
                            </div>
                            <div class="col-md-2 text-end">
                                <button class="btn btn-dark" onclick="grava_detento();"><i class="fa fa-floppy-o"></i> Gravar</button>
                            </div>
                        </div>                            
                    </div>
                </div>
            </div>
        </div>                      
    </div>
</div>
