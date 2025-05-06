<div class="modal fade" id="modal_cadastra_presidiario" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container-fluid default-page">

                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><i class="fa fa-plus fa-fw"></i>Cadastrar Presidiário</h4>
                </div>

                <div class="card" style="background-color:Gray;">
                    <div class="card-body">
                        <div id="div_check_cns">
                            <form class="theme-form" id="FRM_CAD_PRESIDIARIO">
                                <div class="row">
                                    <div class="col-xl-4"><br>
                                        <label class="col-form-label pt-0"
                                            for="cpf_detento"><b>CPF*</b></label>
                                        <input class="form-control" id="cpf_detento"
                                            type="text" aria-describedby="emailHelps"
                                            placeholder="CPF" onchange="checa_cadastro('CPF');">
                                    </div>
                                    <div class="col-xl-8"><br>
                                        <label class="col-form-label pt-0"
                                            for="nome_detento"><b>Nome do Detento*</b> sem abreviação</label>
                                        <input class="form-control" id="nome_detento"
                                            type="text" aria-describedby="emailHelps"
                                            placeholder="Nome completo">
                                    </div>
                                </div>    
                                <div class="row">
                                    <div class="col-xl-6"><br>
                                        <label class="col-form-label pt-0" for="data_nascimento"><b>Data
                                                de Nascimento*</b></label>
                                        <input class="form-control" id="data_nascimento"
                                            type="date" placeholder="Data do Nascimento">
                                    </div>
                                    <div class="col-xl-6"><br>
                                        <label class="col-form-label pt-0"
                                                for="estado_civil"><b>Estado Civil*</b>
                                        </label>
                                        <input class="form-control" id="estado_civil"
                                            type="text" aria-describedby="emailHelps" placeholder="Estado Civil">
                                    </div>                                                                                                                                                        
                                </div>                               
                                <div class="row">
                                    <div class="col-xl-6"><br>
                                        <label class="col-form-label pt-0"
                                            for="nome_pai"><b>Nome do Pai</b> sem abreviação</label>
                                        <input class="form-control" id="nome_pai"
                                            type="text" aria-describedby="emailHelps"
                                            placeholder="Nome do Pai">
                                    </div>
                                    <div class="col-xl-6"><br>
                                        <label class="col-form-label pt-0"
                                            for="nome_mae"><b>Nome da Mãe*</b> sem abreviação</label>
                                        <input class="form-control" id="nome_mae"
                                            type="text" aria-describedby="emailHelps"
                                            placeholder="Nome da Mãe">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-4"><br>
                                        <label for="pavilhao"><b>Escolha um Pavilhão*</b></label><br>
                                        <select id="pavilhao" class="form-select" aria-label="Default select example">
                                            <option value="0"> Escolha um Pavilhão</option>
                                            <option value="A"> Pavilhão A</option>
                                            <option value="B"> Pavilhão B</option>
                                            <option value="C"> Pavilhão C</option>
                                        </select>
                                    </div> 
                                    <div class="col-xl-4"><br>
                                        <label for="cela"><b>Escolha uma Cela*</b></label><br>
                                        <select id="cela" class="form-select" aria-label="Default select example">
                                            <option value="0"> Escolha uma Cela</option>
                                            <option value="1"> Cela 1</option>
                                            <option value="2"> Cela 2</option>
                                            <option value="3"> Cela 3</option>
                                            <option value="4"> Cela 4</option>
                                            <option value="5"> Cela 5</option>
                                            <option value="6"> Cela 6</option>
                                        </select>
                                    </div> 
                                    <div class="col-xl-4"><br>
                                        <label for="tipo_crime"><b>Tipo de Crime</b></label><br>
                                        <select id="tipo_crime" class="form-select" aria-label="Default select example">
                                            <option value="0"> Escolha um tipo de Crime</option>
                                            <option value="Roubo"> Roubo</option>
                                            <option value="Assalto"> Assalto</option>
                                            <option value="Assassinato"> Assassinato</option>
                                            <option value="Estelionato"> Estelionato</option>
                                            <option value="Latrocínio"> Latrocínio</option>
                                            <option value="Agressão"> Agressão</option>
                                        </select>
                                    </div>                                  
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="row">
                            <div class="col-lg-10 text-start">
                                <div id="DIV_MSG_CAD_DETENTO_GERAL"></div>
                            </div>
                            <div class="col-lg-2 text-end">
                                <button class="btn btn-dark" onclick="grava_detento();"><i class="fa fa-floppy-o"></i> Gravar</button>
                            </div>
                        </div>                            
                    </div>
                </div>
            </div>
        </div>                      
    </div>
</div>