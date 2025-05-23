<?php
session_start();

require_once '../config/Database.php';
require_once '../classes/Paciente.php';
require_once '../classes/Medico.php';
require_once '../classes/Consulta.php';

// PROCESSAMENTO DO CADASTRO DE PACIENTE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['paciente_name'])) {
    $pacienteName = filter_input(INPUT_POST, 'paciente_name');
    $pacienteEmail = filter_input(INPUT_POST, 'paciente_email');
    $pacienteDt = filter_input(INPUT_POST, 'paciente_dt');
    $pacienteSexo = filter_input(INPUT_POST, 'paciente_sexo');
    $pacientePassword = $_POST['paciente_senha'];
    $clinicaId = filter_input(INPUT_POST, 'clinica_id');

    if ($pacienteName && $pacienteEmail && $pacienteDt && $pacienteSexo && $pacientePassword) {
        $paciente = new Paciente($pacienteName, $pacienteEmail, $pacienteDt, $pacienteSexo, $pacientePassword, $clinicaId);
        $paciente->cadastrar();
        $_SESSION['success_message'] = "Paciente cadastrado com sucesso!";
    } else {
        $_SESSION['error_message'] = "Erro: Todos os campos são obrigatórios.";
    }
}

$clinicaId = $_SESSION['id'];

$paciente = new Paciente(null, null, null, null, null, null);
$pacientes = $paciente->getAll($clinicaId);

$medico = new Medico(null, null, null, null, null, null);
$medicos = $medico->getAll($clinicaId);

$consulta = new Consulta(null, null, null, null, null);
$consultas = $consulta->getAll($clinicaId);

$adminName = $_SESSION['nome'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="icon" href="../public/img/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="/clinic_management/public/styles/admin_master/admin_master.css">
  <link rel="stylesheet" href="/clinic_management/public/styles/global/global.css">
  <link rel="stylesheet" href="/clinic_management/public/styles/admin_padrao/homepage.css">
  <title>Dashboard - Recepcionista</title>
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
    <h1 class="wellcome-title poppins-semibold c11">Bem-vindo, <?php echo htmlspecialchars($adminName); ?></h1>

    <?php
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
        unset($_SESSION['success_message']);
    }
    if (isset($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
        unset($_SESSION['error_message']);
    }
    ?>

    <div class="forms">
      <!-- Formulário Cadastrar Paciente -->
      <form method="post"
        <h2 class="form-title poppins-semibold c11">Cadastrar Paciente</h2>
        <div class="input-container">
          <label class="roboto-regular">Nome do paciente <span class="text-danger">*</span></label>
          <input type="text" class="roboto-regular" name="paciente_name" placeholder="Nome do paciente*" required maxlength="100">
        </div>
        <div class="input-container">
          <label class="roboto-regular">Data de nascimento <span class="text-danger">*</span></label>
          <input type="date" class="roboto-regular" name="paciente_dt" placeholder="Data de nascimento*" required>
        </div>
        <div class="input-container">
          <label class="roboto-regular">Sexo <span class="text-danger">*</span></label>
          <select id="paciente_sexo" name="paciente_sexo" required>
            <option value="m">Masculino</option>
            <option value="f">Feminino</option>
          </select>
        </div>
        <div class="input-container">
          <label class="roboto-regular">Email <span class="text-danger">*</span></label>
          <input type="email" class="roboto-regular" name="paciente_email" placeholder="Email*" required maxlength="100">
        </div>
        <div class="input-container">
          <label class="roboto-regular">Senha <span class="text-danger">*</span></label>
          <input type="password" class="roboto-regular" name="paciente_senha" placeholder="Senha*" required minlength="6">
        </div>
        <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
        <button type="submit" class="sign-up-btn-modal poppins-semibold c01">Cadastrar</button>
      </form>

      <!-- Formulário Cadastrar Médico -->
      <form method="post" action="/clinic_management/auth/register_medico.php">
        <h2 class="form-title poppins-semibold c11">Cadastrar Médico</h2>
        <div class="input-container">
          <label class="roboto-regular">Nome do médico <span class="text-danger">*</span></label>
          <input type="text" class="roboto-regular" name="medico_name" placeholder="Nome do médico*" required maxlength="100">
        </div>
        <div class="input-container">
          <label class="roboto-regular">Especialidade <span class="text-danger">*</span></label>
          <input type="text" class="roboto-regular" name="medico_especialidade" placeholder="Especialidade*" required maxlength="100">
        </div>
        <div class="input-container">
          <label class="roboto-regular">CRM <span class="text-danger">*</span></label>
          <input type="text" class="roboto-regular" name="medico_crm" placeholder="CRM*" required maxlength="20">
        </div>
        <div class="input-container">
          <label class="roboto-regular">Email <span class="text-danger">*</span></label>
          <input type="email" class="roboto-regular" name="medico_email" placeholder="Email*" required maxlength="100">
        </div>
        <div class="input-container">
          <label class="roboto-regular">Senha <span class="text-danger">*</span></label>
          <input type="password" class="roboto-regular" name="medico_senha" placeholder="Senha*" required minlength="6">
        </div>
        <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
        <button type="submit" class="sign-up-btn-modal poppins-semibold c01">Cadastrar</button>
      </form>
    </div>

    <!-- Tabelas de Usuários -->
    <div>
      <div class="header-tables">
        <h3 class="poppins-semibold c11">Lista de Usuários</h3>
        <div class="tables-change-btns">
          <button class="poppins-semibold c01 active" onclick="showTable('pacientes')">Pacientes</button>
          <button class="poppins-semibold c01" onclick="showTable('medicos')">Médicos</button>
          <button class="poppins-semibold c01" onclick="showTable('consultas')">Consultas</button>
        </div>
      </div>

      <!-- TABELA DE PACIENTES -->
      <table id="pacientes" class="tab active">
        <thead>
          <tr class="c01 poppins-medium">
            <th class="first">#</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Data de Nascimento</th>
            <th>Sexo</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pacientes as $paciente): ?>
            <tr class="registro roboto-regular">
              <td><?php echo htmlspecialchars($paciente['id']); ?></td>
              <td><?php echo htmlspecialchars($paciente['nome']); ?></td>
              <td><?php echo htmlspecialchars($paciente['email']); ?></td>
              <td><?php echo htmlspecialchars($paciente['data_nascimento']); ?></td>
              <td><?php echo htmlspecialchars($paciente['sexo']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- TABELA DE MÉDICOS -->
      <table id="medicos" class="tab">
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

      <!-- TABELA DE CONSULTAS -->
      <table id="consultas" class="tab">
        <thead>
          <tr class="c01 poppins-medium">
            <th class="first">#</th>
            <th>Paciente (Email)</th>
            <th>Médico (CRM)</th>
            <th>Data</th>
            <th>Horário</th>
            <th class="last">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($consultas as $consulta): ?>
            <tr class="registro roboto-regular">
              <td><?php echo htmlspecialchars($consulta['id']); ?></td>
              <td><?php echo htmlspecialchars($consulta['paciente_email']); ?></td>
              <td><?php echo htmlspecialchars($consulta['medico_crm']); ?></td>
              <td><?php echo htmlspecialchars($consulta['data']); ?></td>
              <td><?php echo htmlspecialchars($consulta['horario']); ?></td>
              <td>
                <form class="form-delete-table" method="post" action="/clinic_management/auth/delete_consulta.php" onsubmit="return confirm('Você tem certeza que deseja excluir esta consulta?');">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($consulta['id']); ?>">
                  <button class="roboto-regular c11" type="submit">Excluir</button>
                </form>
              </td>
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
            <label class="roboto-regular">Paciente Email <span class="text-danger">*</span></label>
            <input type="text" class="roboto-regular" name="paciente_email" placeholder="Paciente Email*" required maxlength="100">
          </div>
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
          <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
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

    function showTable(tableId) {
      const tables = document.querySelectorAll('.tab');
      tables.forEach(table => table.classList.remove('active'));
      document.getElementById(tableId).classList.add('active');
    }
  </script>
</body>
</html>