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
  <title>Dashboard - Recepcionista</title>
  
  <style>
    :root {
      --orange-primary: #f97316;
      --orange-hover: #ea580c;
      --orange-light: #fed7aa;
      --gray-50: #f9fafb;
      --gray-100: #f3f4f6;
      --gray-200: #e5e7eb;
      --gray-300: #d1d5db;
      --gray-700: #374151;
      --gray-800: #1f2937;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Roboto', sans-serif;
      background-color: var(--gray-50);
      min-height: 100vh;
    }

    /* Header Styles */
    header {
      background: linear-gradient(135deg, var(--orange-primary), var(--orange-hover));
      color: white;
      padding: 1rem 1.5rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header img {
      height: 2rem;
    }

    .header-menu-admin {
      display: flex;
      gap: 1rem;
      align-items: center;
    }

    .open-modal-btn, .exit-session-btn {
      background: transparent;
      border: 1px solid rgba(255, 255, 255, 0.3);
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      text-decoration: none;
      transition: all 0.2s;
      font-weight: 500;
    }

    .open-modal-btn:hover, .exit-session-btn:hover {
      background: rgba(255, 255, 255, 0.1);
      color: white;
      text-decoration: none;
    }

    /* Container */
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem 1.5rem;
    }

    /* Welcome Section */
    .wellcome-title {
      font-size: 2rem;
      font-weight: 700;
      color: var(--gray-800);
      margin-bottom: 0.5rem;
    }

    .title-underline {
      width: 4rem;
      height: 0.25rem;
      background: var(--orange-primary);
      border-radius: 0.125rem;
      margin-bottom: 2rem;
    }

    /* Forms Section */
    .forms {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
      gap: 2rem;
      margin-bottom: 3rem;
    }

    .form-card {
      background: white;
      border-radius: 0.75rem;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: all 0.3s;
    }

    .form-card:hover {
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .form-header {
      background: linear-gradient(135deg, var(--orange-primary), var(--orange-hover));
      color: white;
      padding: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .form-title {
      font-size: 1.25rem;
      font-weight: 600;
      margin: 0;
    }

    .form-content {
      padding: 1.5rem;
    }

    .input-container {
      margin-bottom: 1rem;
    }

    .input-container label {
      display: block;
      font-weight: 500;
      color: var(--gray-700);
      margin-bottom: 0.5rem;
      font-size: 0.875rem;
    }

    .input-container input,
    .input-container select {
      width: 100%;
      padding: 0.75rem;
      border: 2px solid var(--gray-300);
      border-radius: 0.5rem;
      font-size: 1rem;
      transition: all 0.2s;
      background: white;
    }

    .input-container input:focus,
    .input-container select:focus {
      outline: none;
      border-color: var(--orange-primary);
      box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
    }

    .sign-up-btn-modal {
      width: 100%;
      background: var(--orange-primary);
      color: white;
      border: none;
      padding: 0.75rem;
      border-radius: 0.5rem;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.2s;
      margin-top: 1rem;
    }

    .sign-up-btn-modal:hover {
      background: var(--orange-hover);
      transform: translateY(-1px);
    }

    /* Tables Section */
    .tables-section {
      background: white;
      border-radius: 0.75rem;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .header-tables {
      padding: 1.5rem;
      border-bottom: 1px solid var(--gray-200);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .header-tables h3 {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--gray-800);
      margin: 0;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .tables-change-btns {
      display: flex;
      gap: 0.5rem;
    }

    .tables-change-btns button {
      padding: 0.5rem 1rem;
      border: 2px solid var(--orange-light);
      background: white;
      color: var(--orange-primary);
      border-radius: 0.5rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
    }

    .tables-change-btns button:hover {
      background: var(--orange-light);
      border-color: var(--orange-primary);
    }

    .tables-change-btns button.active {
      background: var(--orange-primary);
      color: white;
      border-color: var(--orange-primary);
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    /* Table Styles */
    .tab {
      width: 100%;
      display: none;
      border-collapse: collapse;
    }

    .tab.active {
      display: table;
    }

    .tab thead tr {
      background: var(--orange-primary);
      color: white;
    }

    .tab th {
      padding: 1rem 1.5rem;
      text-align: left;
      font-weight: 600;
      font-size: 0.875rem;
    }

    .tab td {
      padding: 1rem 1.5rem;
      border-bottom: 1px solid var(--gray-200);
    }

    .tab tbody tr:hover {
      background: var(--gray-50);
    }

    .tab tbody tr:nth-child(even) {
      background: var(--gray-50);
    }

    .tab tbody tr:nth-child(even):hover {
      background: var(--gray-100);
    }

    /* Modal Styles */
    .modal-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1000;
      padding: 1rem;
    }

    .modal-box {
      background: white;
      border-radius: 0.75rem;
      width: 100%;
      max-width: 500px;
      max-height: 90vh;
      overflow-y: auto;
    }

    .modal-title {
      background: var(--orange-primary);
      color: white;
      padding: 1.5rem;
      margin: 0;
      font-size: 1.25rem;
      font-weight: 600;
      border-radius: 0.75rem 0.75rem 0 0;
    }

    .modal-content {
      padding: 1.5rem;
    }

    .close-modal-btn {
      width: 100%;
      background: var(--gray-200);
      color: var(--gray-700);
      border: none;
      padding: 0.75rem;
      border-radius: 0 0 0.75rem 0.75rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
    }

    .close-modal-btn:hover {
      background: var(--gray-300);
    }

    /* Alert Styles */
    .alert {
      padding: 1rem;
      border-radius: 0.5rem;
      margin-bottom: 1rem;
      font-weight: 500;
    }

    .alert-success {
      background: #d1fae5;
      color: #065f46;
      border: 1px solid #a7f3d0;
    }

    .alert-danger {
      background: #fee2e2;
      color: #991b1b;
      border: 1px solid #fca5a5;
    }

    /* Form Delete Button */
    .form-delete-table button {
      background: #dc2626;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      font-size: 0.875rem;
      cursor: pointer;
      transition: all 0.2s;
    }

    .form-delete-table button:hover {
      background: #b91c1c;
    }

    /* Icons */
    .icon {
      width: 1.25rem;
      height: 1.25rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .forms {
        grid-template-columns: 1fr;
      }
      
      .header-tables {
        flex-direction: column;
        align-items: stretch;
      }
      
      .tables-change-btns {
        justify-content: center;
      }
      
      .tab th,
      .tab td {
        padding: 0.75rem;
        font-size: 0.875rem;
      }
    }
  </style>
</head>

<body>
  <header>
    <img src="/clinic_management/public/img/vitta-white.svg" alt="Vitta Clinic">
    <nav class="header-menu-admin">
      <a href="#" class="open-modal-btn roboto-regular" onclick="openModal()">
        <i class="bi bi-calendar-plus"></i> Agendar Consulta
      </a>
      <button type="button" onclick="location.href='logout.php'" class="exit-session-btn poppins-semibold">
        <i class="bi bi-box-arrow-right"></i> Sair da Conta
      </button>
    </nav>
  </header>

  <div class="container">
    <h1 class="wellcome-title poppins-semibold">Bem-vindo, <?php echo htmlspecialchars($adminName); ?></h1>
    <div class="title-underline"></div>

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
      <div class="form-card">
        <div class="form-header">
          <i class="bi bi-person-plus icon"></i>
          <h2 class="form-title poppins-semibold">Cadastrar Paciente</h2>
        </div>
        <div class="form-content">
          <form method="post">
            <div class="input-container">
              <label class="roboto-regular">Nome do paciente <span style="color: #dc2626;">*</span></label>
              <input type="text" class="roboto-regular" name="paciente_name" placeholder="Nome do paciente*" required maxlength="100">
            </div>
            <div class="input-container">
              <label class="roboto-regular">Data de nascimento <span style="color: #dc2626;">*</span></label>
              <input type="date" class="roboto-regular" name="paciente_dt" required max="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="input-container">
              <label class="roboto-regular">Sexo <span style="color: #dc2626;">*</span></label>
              <select name="paciente_sexo" required>
                <option value="">Selecione o sexo</option>
                <option value="m">Masculino</option>
                <option value="f">Feminino</option>
              </select>
            </div>
            <div class="input-container">
              <label class="roboto-regular">Email <span style="color: #dc2626;">*</span></label>
              <input type="email" class="roboto-regular" name="paciente_email" placeholder="Email*" required maxlength="100">
            </div>
            <div class="input-container">
              <label class="roboto-regular">Senha <span style="color: #dc2626;">*</span></label>
              <input type="password" class="roboto-regular" name="paciente_senha" placeholder="Senha*" required minlength="6">
            </div>
            <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
            <button type="submit" class="sign-up-btn-modal poppins-semibold">Cadastrar</button>
          </form>
        </div>
      </div>

      <!-- Formulário Cadastrar Médico -->
      <div class="form-card">
        <div class="form-header">
          <i class="bi bi-person-badge icon"></i>
          <h2 class="form-title poppins-semibold">Cadastrar Médico</h2>
        </div>
        <div class="form-content">
          <form method="post" action="/clinic_management/auth/register_medico.php">
            <div class="input-container">
              <label class="roboto-regular">Nome do médico <span style="color: #dc2626;">*</span></label>
              <input type="text" class="roboto-regular" name="medico_name" placeholder="Nome do médico*" required maxlength="100">
            </div>
            <div class="input-container">
              <label class="roboto-regular">Especialidade <span style="color: #dc2626;">*</span></label>
              <input type="text" class="roboto-regular" name="medico_especialidade" placeholder="Especialidade*" required maxlength="100">
            </div>
            <div class="input-container">
              <label class="roboto-regular">CRM <span style="color: #dc2626;">*</span></label>
              <input type="text" class="roboto-regular" name="medico_crm" placeholder="CRM*" required maxlength="20">
            </div>
            <div class="input-container">
              <label class="roboto-regular">Email <span style="color: #dc2626;">*</span></label>
              <input type="email" class="roboto-regular" name="medico_email" placeholder="Email*" required maxlength="100">
            </div>
            <div class="input-container">
              <label class="roboto-regular">Senha <span style="color: #dc2626;">*</span></label>
              <input type="password" class="roboto-regular" name="medico_senha" placeholder="Senha*" required minlength="6">
            </div>
            <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
            <button type="submit" class="sign-up-btn-modal poppins-semibold">Cadastrar</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Tabelas de Usuários -->
    <div class="tables-section">
      <div class="header-tables">
        <h3 class="poppins-semibold">
          <i class="bi bi-people icon"></i>
          Lista de Usuários
        </h3>
        <div class="tables-change-btns">
          <button class="poppins-semibold active" onclick="showTable('pacientes')">Pacientes</button>
          <button class="poppins-semibold" onclick="showTable('medicos')">Médicos</button>
          <button class="poppins-semibold" onclick="showTable('consultas')">Consultas</button>
        </div>
      </div>

      <!-- TABELA DE PACIENTES -->
      <table id="pacientes" class="tab active">
        <thead>
          <tr>
            <th>#</th>
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
              <td><?php echo htmlspecialchars($paciente['sexo'] === 'm' ? 'Masculino' : 'Feminino'); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- TABELA DE MÉDICOS -->
      <table id="medicos" class="tab">
        <thead>
          <tr>
            <th>#</th>
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
          <tr>
            <th>#</th>
            <th>Paciente (Email)</th>
            <th>Médico (CRM)</th>
            <th>Data</th>
            <th>Horário</th>
            <th>Ações</th>
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
                  <button class="roboto-regular" type="submit">
                    <i class="bi bi-trash"></i> Excluir
                  </button>
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
    <h2 class="modal-title poppins-semibold">
      <i class="bi bi-calendar-plus"></i> Agendar Consulta
    </h2>
    <div class="modal-content">
      <form method="post" action="/clinic_management/auth/create_consulta.php">
        <div class="input-container">
          <label class="roboto-regular">Paciente Email <span style="color: #dc2626;">*</span></label>
          <input type="text" class="roboto-regular" name="paciente_email" placeholder="Paciente Email*" required maxlength="100">
        </div>
        <div class="input-container">
          <label class="roboto-regular">Médico CRM <span style="color: #dc2626;">*</span></label>
          <input type="text" class="roboto-regular" name="medico_crm" placeholder="Médico CRM*" required maxlength="20">
        </div>
        <div class="input-container">
          <label class="roboto-regular">Data <span style="color: #dc2626;">*</span></label>
          <input type="date" class="roboto-regular" name="data" required min="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="input-container">
          <label class="roboto-regular">Horário <span style="color: #dc2626;">*</span></label>
          <input type="time" class="roboto-regular" name="horario" required>
        </div>
        <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
        <button type="submit" class="sign-up-btn-modal poppins-semibold">Agendar</button>
      </form>
    </div>
    <button class="close-modal-btn" onclick="closeModal()">Fechar</button>
  </div>
</div>

  <script>
    function openModal() {
      document.getElementById('modal').style.display = 'flex';
    }

    function closeModal() {
      document.getElementById('modal').style.display = 'none';
    }

    function showTable(tableId) {
      // Remove active class from all buttons
      const buttons = document.querySelectorAll('.tables-change-btns button');
      buttons.forEach(button => button.classList.remove('active'));
      
      // Add active class to clicked button
      event.target.classList.add('active');
      
      // Hide all tables
      const tables = document.querySelectorAll('.tab');
      tables.forEach(table => table.classList.remove('active'));
      
      // Show selected table
      document.getElementById(tableId).classList.add('active');
    }

    // Close modal when clicking outside
    document.getElementById('modal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeModal();
      }
    });
  </script>
</body>
</html>