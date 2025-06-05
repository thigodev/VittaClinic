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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="icon" href="../public/img/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <title>Dashboard - Paciente</title>
  
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
      --blue-600: #2563eb;
      --green-600: #16a34a;
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

    .header-brand {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .header-brand img {
      height: 2rem;
    }

    .header-brand .brand-text {
      font-size: 1.5rem;
      font-weight: 700;
      font-family: 'Poppins', sans-serif;
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
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .open-modal-btn:hover, .exit-session-btn:hover {
      background: rgba(255, 255, 255, 0.1);
      color: white;
      text-decoration: none;
      transform: translateY(-1px);
    }

    /* Container */
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem 1.5rem;
    }

    /* Welcome Section */
    .welcome-section {
      margin-bottom: 2rem;
    }

    .wellcome-title {
      font-size: 2rem;
      font-weight: 700;
      color: var(--gray-800);
      margin-bottom: 0.5rem;
      font-family: 'Poppins', sans-serif;
    }

    .title-underline {
      width: 4rem;
      height: 0.25rem;
      background: var(--orange-primary);
      border-radius: 0.125rem;
      margin-bottom: 1rem;
    }

    .patient-info {
      background: white;
      border-radius: 0.75rem;
      padding: 1.5rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      margin-bottom: 2rem;
    }

    .patient-info h3 {
      color: var(--gray-800);
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
    }

    .info-item {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
    }

    .info-label {
      font-size: 0.875rem;
      color: var(--gray-700);
      font-weight: 500;
    }

    .info-value {
      font-size: 1rem;
      color: var(--gray-800);
      font-weight: 600;
    }

    /* Tables Section */
    .tables-section {
      background: white;
      border-radius: 0.75rem;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      margin-bottom: 2rem;
    }

    .header-tables {
      padding: 1.5rem;
      border-bottom: 1px solid var(--gray-200);
      background: var(--gray-50);
    }

    .header-tables h3 {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--gray-800);
      margin: 0;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-family: 'Poppins', sans-serif;
    }

    /* Table Styles */
    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table thead tr {
      background: var(--orange-primary);
      color: white;
    }

    table th {
      padding: 1rem 1.5rem;
      text-align: left;
      font-weight: 600;
      font-size: 0.875rem;
      font-family: 'Poppins', sans-serif;
    }

    table td {
      padding: 1rem 1.5rem;
      border-bottom: 1px solid var(--gray-200);
      font-size: 0.875rem;
    }

    table tbody tr:hover {
      background: var(--gray-50);
    }

    table tbody tr:nth-child(even) {
      background: var(--gray-50);
    }

    table tbody tr:nth-child(even):hover {
      background: var(--gray-100);
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 3rem 1.5rem;
      color: var(--gray-700);
    }

    .empty-state i {
      font-size: 3rem;
      color: var(--gray-300);
      margin-bottom: 1rem;
    }

    .empty-state h4 {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: var(--gray-800);
    }

    .empty-state p {
      font-size: 0.875rem;
      color: var(--gray-600);
    }

    /* Status Badges */
    .status-badge {
      padding: 0.25rem 0.75rem;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
    }

    .status-upcoming {
      background: var(--orange-light);
      color: var(--orange-hover);
    }

    .status-completed {
      background: #dcfce7;
      color: var(--green-600);
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
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .modal-title {
      background: var(--orange-primary);
      color: white;
      padding: 1.5rem;
      margin: 0;
      font-size: 1.25rem;
      font-weight: 600;
      border-radius: 0.75rem 0.75rem 0 0;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-family: 'Poppins', sans-serif;
    }

    .modal-content {
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
      font-family: 'Poppins', sans-serif;
    }

    .sign-up-btn-modal:hover {
      background: var(--orange-hover);
      transform: translateY(-1px);
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

    /* Icons */
    .icon {
      width: 1.25rem;
      height: 1.25rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .header-brand .brand-text {
        display: none;
      }
      
      .info-grid {
        grid-template-columns: 1fr;
      }
      
      table th,
      table td {
        padding: 0.75rem;
        font-size: 0.875rem;
      }
      
      .wellcome-title {
        font-size: 1.5rem;
      }
    }

    /* Consultations Section */
    .consultations-section {
      margin-top: 2rem;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .section-header h3 {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--gray-800);
      margin: 0;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-family: 'Poppins', sans-serif;
    }

    .view-all-link {
      color: var(--orange-primary);
      text-decoration: none;
      font-weight: 500;
      font-size: 0.875rem;
      transition: color 0.2s;
    }

    .view-all-link:hover {
      color: var(--orange-hover);
      text-decoration: underline;
    }

    .consultations-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 1.5rem;
    }

    .consultation-card {
      background: white;
      border-radius: 1rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: all 0.3s;
      border: 2px solid transparent;
    }

    .consultation-card:hover {
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
      transform: translateY(-2px);
    }

    .consultation-card.upcoming {
      border-color: var(--orange-primary);
    }

    .consultation-card.completed {
      border-color: var(--green-600);
      opacity: 0.8;
    }

    .card-header {
      padding: 1.25rem 1.25rem 0;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }

    .date-time {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
    }

    .date {
      font-size: 1rem;
      font-weight: 600;
      color: var(--gray-800);
      font-family: 'Poppins', sans-serif;
    }

    .time {
      font-size: 0.875rem;
      color: var(--gray-600);
      font-weight: 500;
    }

    .status-indicator {
      display: flex;
      align-items: center;
    }

    .status-icon {
      font-size: 1.25rem;
    }

    .status-icon.upcoming {
      color: var(--orange-primary);
    }

    .status-icon.completed {
      color: var(--green-600);
    }

    .card-content {
      padding: 1.25rem;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .specialty-info {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .specialty-icon {
      width: 3rem;
      height: 3rem;
      background: var(--orange-light);
      border-radius: 0.75rem;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--orange-primary);
      font-size: 1.25rem;
    }

    .specialty-details {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
    }

    .specialty-name {
      font-size: 1rem;
      font-weight: 600;
      color: var(--gray-800);
      font-family: 'Poppins', sans-serif;
    }

    .consultation-type {
      font-size: 0.875rem;
      color: var(--gray-600);
    }

    .doctor-info,
    .clinic-info {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.875rem;
      color: var(--gray-700);
    }

    .doctor-info i,
    .clinic-info i {
      color: var(--gray-500);
      font-size: 1rem;
    }

    /* Empty Consultations */
    .empty-consultations {
      background: white;
      border-radius: 1rem;
      padding: 3rem 2rem;
      text-align: center;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .empty-icon {
      font-size: 4rem;
      color: var(--gray-300);
      margin-bottom: 1.5rem;
    }

    .empty-consultations h4 {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--gray-800);
      margin-bottom: 0.5rem;
      font-family: 'Poppins', sans-serif;
    }

    .empty-consultations p {
      color: var(--gray-600);
      margin-bottom: 2rem;
      max-width: 400px;
      margin-left: auto;
      margin-right: auto;
    }

    .schedule-btn {
      background: var(--orange-primary);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 0.5rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-family: 'Poppins', sans-serif;
    }

    .schedule-btn:hover {
      background: var(--orange-hover);
      transform: translateY(-1px);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .consultations-grid {
        grid-template-columns: 1fr;
      }
      
      .section-header {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
      }
      
      .consultation-card {
        margin: 0 -0.5rem;
      }
    }
  </style>
</head>

<body>
  <header>
    <div class="header-brand">
      <img src="/clinic_management/public/img/vitta-white.svg" alt="Vitta Clinic">
    </div>
    <nav class="header-menu-admin">
      <a href="#" class="open-modal-btn roboto-regular" onclick="openModal()">
        <i class="bi bi-calendar-plus"></i>
        Agendar Consulta
      </a>
      <button type="button" onclick="location.href='logout.php'" class="exit-session-btn poppins-semibold">
        <i class="bi bi-box-arrow-right"></i>
        Sair da Conta
      </button>
    </nav>
  </header>

  <div class="container">
    <div class="welcome-section">
      <h1 class="wellcome-title">Bem-vindo(a), <?php echo htmlspecialchars($pacienteName); ?></h1>
      <div class="title-underline"></div>
    </div>

    <!-- Informações do Paciente -->
    <div class="patient-info">
      <h3>
        <i class="bi bi-person-circle icon"></i>
        Suas Informações
      </h3>
      <div class="info-grid">
        <div class="info-item">
          <span class="info-label">Nome Completo</span>
          <span class="info-value"><?php echo htmlspecialchars($pacienteName); ?></span>
        </div>
        <div class="info-item">
          <span class="info-label">Email</span>
          <span class="info-value"><?php echo htmlspecialchars($pacienteEmail); ?></span>
        </div>
        <div class="info-item">
          <span class="info-label">Data de Nascimento</span>
          <span class="info-value"><?php echo htmlspecialchars(date('d/m/Y', strtotime($pacienteDt))); ?></span>
        </div>
        <div class="info-item">
          <span class="info-label">Sexo</span>
          <span class="info-value"><?php echo htmlspecialchars($pacienteSexo === 'm' ? 'Masculino' : 'Feminino'); ?></span>
        </div>
      </div>
    </div>

    <!-- Lista de Médicos -->
    <div class="tables-section">
      <div class="header-tables">
        <h3>
          <i class="bi bi-people icon"></i>
          Médicos Disponíveis
        </h3>
      </div>
      <div class="table-container">
        <table>
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
                <td>
                  <span class="status-badge" style="background: #e0f2fe; color: #0277bd;">
                    <?php echo htmlspecialchars($medico['especialidade']); ?>
                  </span>
                </td>
                <td><?php echo htmlspecialchars($medico['crm']); ?></td>
                <td><?php echo htmlspecialchars($medico['email']); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Próximas Consultas -->
    <div class="consultations-section">
      <div class="section-header">
        <h3>
          <i class="bi bi-calendar-check icon"></i>
          Próximas Consultas
        </h3>
        <?php if (!empty($consultas)): ?>
          <a href="#" class="view-all-link">Ver todas</a>
        <?php endif; ?>
      </div>
      
      <?php if (empty($consultas)): ?>
        <div class="empty-consultations">
          <div class="empty-icon">
            <i class="bi bi-calendar-x"></i>
          </div>
          <h4>Nenhuma consulta agendada</h4>
          <p>Você ainda não possui consultas marcadas. Clique em "Agendar Consulta" para marcar sua primeira consulta.</p>
          <button onclick="openModal()" class="schedule-btn">
            <i class="bi bi-calendar-plus"></i>
            Agendar Primeira Consulta
          </button>
        </div>
      <?php else: ?>
        <div class="consultations-grid">
          <?php foreach ($consultas as $consulta): ?>
            <?php
            $dataConsulta = strtotime($consulta['data_consulta']);
            $hoje = strtotime(date('Y-m-d'));
            $isUpcoming = $dataConsulta >= $hoje;
            
            // Formatação da data
            $dataFormatada = date('l, d/m/Y', $dataConsulta);
            $diasSemana = [
              'Monday' => 'Segunda-feira',
              'Tuesday' => 'Terça-feira', 
              'Wednesday' => 'Quarta-feira',
              'Thursday' => 'Quinta-feira',
              'Friday' => 'Sexta-feira',
              'Saturday' => 'Sábado',
              'Sunday' => 'Domingo'
            ];
            $dataFormatada = str_replace(array_keys($diasSemana), array_values($diasSemana), $dataFormatada);
            ?>
            
            <div class="consultation-card <?php echo $isUpcoming ? 'upcoming' : 'completed'; ?>">
              <div class="card-header">
                <div class="date-time">
                  <span class="date"><?php echo $dataFormatada; ?></span>
                  <span class="time">às <?php echo htmlspecialchars($consulta['horario_consulta']); ?></span>
                </div>
                <div class="status-indicator">
                  <?php if ($isUpcoming): ?>
                    <i class="bi bi-clock status-icon upcoming"></i>
                  <?php else: ?>
                    <i class="bi bi-check-circle status-icon completed"></i>
                  <?php endif; ?>
                </div>
              </div>
              
              <div class="card-content">
                <div class="specialty-info">
                  <div class="specialty-icon">
                    <i class="bi bi-heart-pulse"></i>
                  </div>
                  <div class="specialty-details">
                    <span class="specialty-name">Consulta Médica</span>
                    <span class="consultation-type">Consulta</span>
                  </div>
                </div>
                
                <div class="doctor-info">
                  <i class="bi bi-person-badge"></i>
                  <span>
                    <?php 
                    // Buscar o nome do médico pelo CRM
                    $medicoNome = '';
                    foreach ($medicos as $medico) {
                      if ($medico['crm'] === $consulta['medico_crm']) {
                        $medicoNome = $medico['nome'];
                        break;
                      }
                    }
                    echo htmlspecialchars($medicoNome ?: 'Médico não encontrado');
                    ?>
                  </span>
                </div>
                
                <div class="clinic-info">
                  <i class="bi bi-geo-alt"></i>
                  <span>Vitta Clinic</span>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

  <!-- Modal para Agendar Consulta -->
  <div id="modal" class="modal-container" style="display: none;">
    <div class="modal-box">
      <h2 class="modal-title">
        <i class="bi bi-calendar-plus"></i>
        Agendar Nova Consulta
      </h2>
      <div class="modal-content">
        <form method="post" action="/clinic_management/auth/create_consulta.php">
          <div class="input-container">
            <label class="roboto-regular">Médico CRM <span style="color: #dc2626;">*</span></label>
            <select name="medico_crm" required>
              <option value="">Selecione um médico</option>
              <?php foreach ($medicos as $medico): ?>
                <option value="<?php echo htmlspecialchars($medico['crm']); ?>">
                  <?php echo htmlspecialchars($medico['nome'] . ' - ' . $medico['especialidade'] . ' (CRM: ' . $medico['crm'] . ')'); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="input-container">
            <label class="roboto-regular">Data <span style="color: #dc2626;">*</span></label>
            <input type="date" class="roboto-regular" name="data" required min="<?php echo date('Y-m-d'); ?>">
          </div>
          <div class="input-container">
            <label class="roboto-regular">Horário <span style="color: #dc2626;">*</span></label>
            <input type="time" class="roboto-regular" name="horario" required>
          </div>
          <input type="hidden" name="paciente_email" value="<?php echo htmlspecialchars($pacienteEmail); ?>">
          <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($clinicaId); ?>">
          <button type="submit" class="sign-up-btn-modal">
            <i class="bi bi-check-circle"></i>
            Confirmar Agendamento
          </button>
        </form>
      </div>
      <button class="close-modal-btn" onclick="closeModal()">
        <i class="bi bi-x-circle"></i>
        Fechar
      </button>
    </div>
  </div>

  <script>
    function openModal() {
      document.getElementById('modal').style.display = 'flex';
    }

    function closeModal() {
      document.getElementById('modal').style.display = 'none';
    }

    // Close modal when clicking outside
    document.getElementById('modal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeModal();
      }
    });

    // Set minimum date to today
    document.addEventListener('DOMContentLoaded', function() {
      const dateInput = document.querySelector('input[type="date"]');
      if (dateInput) {
        dateInput.min = new Date().toISOString().split('T')[0];
      }
    });
  </script>
</body>
</html>