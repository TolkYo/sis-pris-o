<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Detentos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color:#1b4965;
    }
    
    .sidebar a:hover {
      background-color: #1a2733;
    }
    .status-btn {
      font-size: 0.8rem;
      padding: 5px 10px;
    }
    .table td, .table th {
      vertical-align: middle;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    
    

    <!-- Conteúdo -->
    <main class="col-md-10 p-4">
      <h3>Cadastro de Detentos</h3>

      <div class="d-flex mb-3">
        <input class="form-control me-2" type="search" placeholder="Nº Registro" id="searchReg">
        <input class="form-control me-2" type="search" placeholder="Nome do Detento" id="searchNome">
        <button class="btn btn-dark me-3" onclick="filterTable()">🔍 Buscar</button>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cadastroModal">+ Cadastrar</button>
      </div>

      <table class="table table-striped table-bordered">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Nº Registro</th>
            <th>Nome do Detento</th>
            <th>Data de Nascimento</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="detentoList">
          <tr>
            <td>#001</td>
            <td>456789123</td>
            <td>João da Silva</td>
            <td>12/05/1982</td>
            <td><span class="badge bg-warning text-dark status-btn">Em análise</span></td>
          </tr>
          <tr>
            <td>#002</td>
            <td>123456789</td>
            <td>Pedro Oliveira</td>
            <td>23/09/1990</td>
            <td><span class="badge bg-success status-btn">Confirmado</span></td>
          </tr>
          <tr>
            <td>#003</td>
            <td>987654321</td>
            <td>Lucas Martins</td>
            <td>10/01/1975</td>
            <td><span class="badge bg-danger status-btn">Recusado</span></td>
          </tr>
        </tbody>
      </table>
    </main>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cadastroModal" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cadastroModalLabel">Novo Detento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <form id="formCadastro">
          <div class="mb-3">
            <label for="registro" class="form-label">Nº Registro</label>
            <input type="text" class="form-control" id="registro" required>
          </div>
          <div class="mb-3">
            <label for="nome" class="form-label">Nome do Detento</label>
            <input type="text" class="form-control" id="nome" required>
          </div>
          <div class="mb-3">
            <label for="dataNascimento" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="dataNascimento" required>
          </div>
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" required>
              <option value="Em análise">Em análise</option>
              <option value="Confirmado">Confirmado</option>
              <option value="Recusado">Recusado</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Filtro de busca
  function filterTable() {
    let regInput = document.getElementById("searchReg").value.toLowerCase();
    let nomeInput = document.getElementById("searchNome").value.toLowerCase();
    let rows = document.querySelectorAll("#detentoList tr");

    rows.forEach(row => {
      let registro = row.cells[1].innerText.toLowerCase();
      let nome = row.cells[2].innerText.toLowerCase();
      row.style.display = (registro.includes(regInput) && nome.includes(nomeInput)) ? "" : "none";
    });
  }

  // Simula cadastro
  document.getElementById("formCadastro").addEventListener("submit", function(event) {
    event.preventDefault();
    let registro = document.getElementById("registro").value;
    let nome = document.getElementById("nome").value;
    let data = document.getElementById("dataNascimento").value;
    let status = document.getElementById("status").value;

    let statusClass = status === "Confirmado" ? "bg-success" : status === "Recusado" ? "bg-danger" : "bg-warning text-dark";

    let newRow = `
      <tr>
        <td>#00X</td>
        <td>${registro}</td>
        <td>${nome}</td>
        <td>${data}</td>
        <td><span class="badge ${statusClass} status-btn">${status}</span></td>
      </tr>
    `;

    document.getElementById("detentoList").insertAdjacentHTML("beforeend", newRow);
    document.getElementById("formCadastro").reset();
    let modal = bootstrap.Modal.getInstance(document.getElementById('cadastroModal'));
    modal.hide();
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
