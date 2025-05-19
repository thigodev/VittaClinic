<?php
require_once '../config/Database.php';
require_once '../classes/Paciente.php';
require_once '../classes/Medico.php';
require_once '../classes/Consulta.php';

session_start();

$pacienteName = $_SESSION['nome'];
$pacienteEmail = $_SESSION['email'];
$pacienteDt = $_SESSION['data_nascimento'];
$pacienteSexo = $_SESSION['sexo'];
$clinicaId = $_SESSION['id'];

// Inicializando as classes
$paciente = new Paciente(null, null, null, null, null, null);
$consultas = $paciente->getConsultas($pacienteEmail);

$medico = new Medico(null, null, null, null, null, null);
$medicos = $medico->getAll($clinicaId);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Roboto:wght@400;500&display=swap"
    rel="stylesheet">
  <link rel="icon" href="../public/img/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="/clinic_management/public/styles/admin_padrao/homepage.css">
  <title>Clinica - Paciente</title>
</head>

<body>
  <header>
    <img src="/clinic_management/public/img/vitta-white.svg">
    <nav class="header-menu-admin">
      <a href="#" class="open-modal-btn roboto-regular c01" onclick="openModal()">Agendar Consulta</a>
      <button type="submit" onclick="location.href='logout.php'" class="exit-session-btn poppins-semibold c01">Sair da Conta</button>
    </nav>
  </header>

  <div class="container">
    <h1 class="wellcome-title poppins-semibold c11">Bem-vindo(a), <?php echo htmlspecialchars($pacienteName); ?></h1>

    <!-- Lista de Consultas -->
    <div>
      <div class="header-tables">
        <h3 class="poppins-semibold c11">Suas Consultas</h3>
      </div>
      <table class="active">
        <thead>
          <tr class="c01 poppins-medium">
            <th class="first">#</th>
            <th>Data da Consulta</th>
            <th>Horário</th>
            <th class="last">Médico</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($consultas as $consulta): ?>
            <tr class="registro roboto-regular">
              <td><?php echo htmlspecialchars($consulta['id']); ?></td>
              <td><?php echo htmlspecialchars($consulta['data_consulta']); ?></td>
              <td><?php echo htmlspecialchars($consulta['horario_consulta']); ?></td>
              <td><?php echo htmlspecialchars($consulta['medico_crm']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Lista de Médicos -->
    <div class="mt-5">
      <div class="header-tables">
        <h3 class="poppins-semibold c11">Lista de Médicos</h3>
      </div>
      <table class="active">
        <thead>
          <tr class="c01 poppins-medium">
            <th class="first">#</th>
            <th>Nome</th>
            <th>Especialidade</th>
            <th>CRM</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($medicos as $medico): ?>
            <tr class="registro roboto-regular">
              <td><?php echo htmlspecialchars($medico['id']); ?></td>
              <td><?php echo htmlspecialchars($medico['nome']); ?></td>
              <td><?php echo htmlspecialchars($medico['especialidade']); ?></td>
              <td><?php echo htmlspecialchars($medico['crm']); ?></td>
              <td><?php echo htmlspecialchars($medico['email']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal para Agendar Consulta -->
  <div id="modal" class="modal-container" style="display: none;">
    <div class="modal-box">
      <h2 class="modal-title poppins-semibold">Agendar Consulta</h2>
      <div class="modal-content">
        <form method="post" action="/clinic_management/auth/create_consulta.php">
          <div class="input-container">
            <label class="roboto-regular">Médico CRM <span class="text-danger">*</span></label>
            <input type="text" class="roboto-regular" name="medico_crm" placeholder="Médico CRM*" required maxlength="20">
          </div>
          <div class="input-container">
            <label class="roboto-regular">Data <span class="text-danger">*</span></label>
            <input type="date" class="roboto-regular" name="data" required>
          </div>
          <div class="input-container">
            <label class="roboto-regular">Horário <span class="text-danger">*</span></label>
            <input type="time" class="roboto-regular" name="horario" required>
          </div>
          <input type="hidden" name="paciente_email" value="<?php echo htmlspecialchars($pacienteEmail); ?>">
          <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($clinicaId); ?>">
          <button type="submit" class="sign-up-btn-modal poppins-semibold c01">Agendar</button>
        </form>
      </div>
      <button class="close-modal-btn" onclick="closeModal()">Fechar</button>
    </div>
  </div>

  <script>
    function openModal() {
      document.getElementById('modal').style.display = 'block';
    }

    function closeModal() {
      document.getElementById('modal').style.display = 'none';
    }
  </script>
</body>

</html>