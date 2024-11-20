<?php
require_once '../config/Database.php';
require_once '../classes/Paciente.php';
require_once '../classes/Medico.php';
require_once '../classes/Consulta.php';

session_start();

$crm = $_SESSION['crm'];
$clinicaId = $_SESSION['id'];

// Inicializando as classes de Medico e Consulta
$medico = new Medico(null, null, null, null, null, null);
$medicos = $medico->getAll($clinicaId);
$consultas = $medico->getConsultas($crm);

// O nome do médico na sessão
$medicoName = $_SESSION['nome'];

// Exemplo de total de consultas realizadas e agendadas
$totalConsultasAgendadas = count($consultas);
$totalConsultasRealizadas = 0; // Aqui você precisaria de lógica para determinar as realizadas
$totalPacientes = count($medicos); // Exemplificando com o número de médicos, mas pode ser pacientes
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="../public/img/favicon.ico">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Roboto:wght@400;500&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="/clinic_management/public/styles/admin_master/admin_master.css">
  <link rel="stylesheet" href="/clinic_management/public/styles/global/geral.css">
  <title>Dashboard - Médico Gestor</title>
</head>

<body class="bg-light">
  <header class="header-master d-flex justify-content-between align-items-center p-3 text-white">
    <img src="/clinic_management/public/img/vitta-white.svg" alt="Logo da clínica" height="50">
    <button type="submit" onclick="location.href='logout.php'" class="btn btn-outline-light" aria-label="Sair">
      <i class="bi bi-box-arrow-right" alt="Ícone de sair"></i>
    </button>
  </header>

  <div class="container my-4">
    <h1 class="wellcome-title poppins-semibold c11">Bem-vindo(a), <?php echo htmlspecialchars($medicoName); ?></h1>

    <div class="row">
      <div class="col-md-4">
        <div class="card shadow-sm border-primary">
          <div class="card-body">
            <h5 class="card-title text-center">Consultas Agendadas</h5>
            <p class="card-text text-center">
              <strong><?php echo $totalConsultasAgendadas; ?></strong> consultas agendadas
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm border-success">
          <div class="card-body">
            <h5 class="card-title text-center">Consultas Realizadas</h5>
            <p class="card-text text-center">
              <strong><?php echo $totalConsultasRealizadas; ?></strong> consultas realizadas
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm border-warning">
          <div class="card-body">
            <h5 class="card-title text-center">Total de Pacientes</h5>
            <p class="card-text text-center">
              <strong><?php echo $totalPacientes; ?></strong> pacientes cadastrados
            </p>
          </div>
        </div>
      </div>
    </div>

    <h3 class="poppins-semibold c11 mt-4">Lista de Consultas</h3>
    <?php if (empty($consultas)): ?>
      <div class="alert alert-info d-flex align-items-center" role="alert">
        <i class="bi bi-info-circle-fill me-2"></i>
        <strong>Sem consultas agendadas</strong> - Não há consultas para mostrar no momento.
      </div>
    <?php else: ?>
      <table class="tab active">
        <thead>
          <tr class="c01 poppins-medium">
            <th>Data da Consulta</th>
            <th>Horário</th>
            <th class="last">Paciente</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($consultas as $consulta): ?>
            <tr class="registro roboto-regular">
              <td><?php echo htmlspecialchars($consulta['data_consulta']); ?></td>
              <td><?php echo htmlspecialchars($consulta['horario_consulta']); ?></td>
              <td><?php echo htmlspecialchars($consulta['paciente_email']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>

  <script type="module" src="../public/scripts/main.js"></script>
</body>

</html>