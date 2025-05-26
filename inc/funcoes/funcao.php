<?php

function lista_presos($nome, $conn)
{
    $sqlNome = '';
    
    if ($nome != '') {
        $nome = strtoupper($nome);
        $nome = $conn->real_escape_string($nome); // segurança contra SQL Injection
        $sqlNome = " AND nome LIKE '$nome%'";
    }

    $sqlQuery = "SELECT * FROM presos 
    WHERE id_preso > 0
    $sqlNome 
    ORDER BY nome ASC
    LIMIT 200";

    $result = $conn->query($sqlQuery);

    if (!$result) {
        die('Erro ao executar a query: ' . $conn->error);
    }

    if ($result->num_rows > 0) {
        $linhas = '';
        while ($row = $result->fetch_assoc()) {
            $id_preso = $row['id_preso'];
            $cpf = isset($row['cpf']) ? formataCPF($row['cpf']) : '';
            $nome = strtoupper($row['nome']);
            $data_nascimento = new DateTime($row['data_nascimento']);
            $data_nascimento = $data_nascimento->format('d/m/Y');
            $pavilhao = $row['pavilhao'];
            $cela = $row['id_cela'];

            $linha = '
                <tr>
                    <td>
                        <div class="btn-group" role="group">
                            <div class="btn-group" role="group">
                                <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">'
                                . sprintf('%05s', $id_preso) . '</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="chama_modal_edit_detento(' . $id_preso . ')">
                                        <b><i class="fa fa-folder-open"></i> Abrir</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>' . $cpf . '</td>
                    <td>' . $nome . '</td>
                    <td>' . $pavilhao . '</td>
                    <td>' . $cela . '</td>
                </tr>
            ';
            $linhas .= $linha;
        }

        return '
            <table class="table table-responsive-sm table-responsive-md table-responsive-lg">
                 <thead>
                      <tr>
                          <th>ID</th>
                          <th>CPF</th>
                          <th>Nome</th>
                          <th>Pavilhão</th>
                          <th>Cela</th>
                      </tr>
                 </thead>
                  <tbody>
                       ' . $linhas . '              
                  </tbody>
            </table>
        ';
    }

    return '
        <table class="table table-responsive-sm table-responsive-md table-responsive-lg">
             <thead>
                  <tr>
                      <th>ID</th>
                      <th>CPF</th>
                      <th>Nome</th>
                      <th>Pavilhão</th>
                      <th>Cela</th>
                  </tr>
             </thead>
              <tbody>
                   <tr>
                        <td colspan="6">Não foram localizados registros de Presos</td>
                   </tr>            
              </tbody>
        </table>
    ';
}

function lista_visitas($nome, $conn)
{
    $sqlNome = '';

    if ($nome != '') {
        $nome = strtoupper($nome);
        $nome = $conn->real_escape_string($nome); // segurança contra SQL Injection
        $sqlNome = " AND nome LIKE '$nome%'";
    }

    $sqlQuery = "SELECT * FROM visitas 
    WHERE id_visita > 0
    $sqlNome 
    ORDER BY nome ASC";

    $result = $conn->query($sqlQuery);

    if (!$result) {
        die('Erro ao executar a query: ' . $conn->error);
    }

    if ($result->num_rows > 0) {
        $linhas = '';
        while ($row = $result->fetch_assoc()) {
            $id_visita = $row['id_visita'];
            $cpf = isset($row['cpf_visita']) ? formataCPF($row['cpf_visita']) : '';
            $nome = strtoupper($row['nome']);
            $grau_parentesco = $row['grau_parentesco'];
            $data_nasci = new DateTime($row['data_nasci_visita']);
            $data_nasci = $data_nasci->format('d/m/Y');
            $nome_detento = $row['nome_detento'];
            $data_visita = new DateTime($row['data_visita']);
            $data_visita = $data_visita->format('d/m/Y');

            $linha = '
                <tr>
                    <td>
                        <div class="btn-group" role="group">
                            <div class="btn-group" role="group">
                                <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">'
                                . sprintf('%05s', $id_visita) . '</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="chama_modal_edit_visita(' . $id_visita . ')">
                                        <b><i class="fa fa-folder-open"></i> Abrir</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>' . $cpf . '</td>
                    <td>' . $nome . '</td>
                    <td>' . $grau_parentesco . '</td>
                    <td>' . $data_nasci . '</td>
                    <td>' . $nome_detento . '</td>
                    <td>' . $data_visita . '</td>
                </tr>
            ';
            $linhas .= $linha;
        }

        return '
            <table class="table table-responsive-sm table-responsive-md table-responsive-lg">
                 <thead>
                      <tr>
                          <th>ID</th>
                          <th>CPF</th>
                          <th>Nome</th>
                          <th>Parentesco</th>
                          <th>Nascimento</th>
                          <th>Detento</th>
                          <th>Data Visita</th>
                      </tr>
                 </thead>
                  <tbody>
                       ' . $linhas . '              
                  </tbody>
            </table>
        ';
    }

    return '
        <table class="table table-responsive-sm table-responsive-md table-responsive-lg">
             <thead>
                  <tr>
                      <th>ID</th>
                      <th>CPF</th>
                      <th>Nome</th>
                      <th>Parentesco</th>
                      <th>Nascimento</th>
                      <th>Detento</th>
                      <th>Data Visita</th>
                  </tr>
             </thead>
              <tbody>
                   <tr>
                        <td colspan="7">Não foram localizados registros de Visitas</td>
                   </tr>            
              </tbody>
        </table>
    ';
}

