<?php
require_once '../config/Database.php';
require_once '../classes/Paciente.php';
require_once '../classes/Medico.php';
require_once '../classes/Consulta.php';

session_start();

$clinicaId = $_SESSION['id'];
// echo '<pre>';
// die(var_dump($clinicaId));
// echo '</pre>';


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
  <link rel="icon" href="img/umbrella.svg">
  <title>Clinica - Admin</title>
  <link rel="stylesheet" href="/clinic_management/public/styles/admin_padrao/homepage.css">
</head>

<body>
  <header>
    <img src="/clinic_management/public/img/vitta-logo-header.svg">
    <nav class="header-menu-admin">
      <a href="#" class="open-modal-btn roboto-regular c01">Agendar Consulta</a>
      <button type="submit" onclick="location.href='logout.php'" class="exit-session-btn poppins-semibold c01">Sair da Conta</button>
    </nav>
  </header>

  <div class="container">
    <h1 class="wellcome-title poppins-semibold c11">Bem vindo, <?php echo htmlspecialchars($adminName); ?></h1>

    <div class="forms">
      <form method="post" action="/clinic_management/auth/register_paciente.php">
        <h2 class="form-title poppins-semibold c11">Cadastrar Paciente</h2>
        <div class="input-container">
          <label class="roboto-regular">Nome do paciente</label>
          <input type="text" class="roboto-regular" name="paciente_name" placeholder="Nome do paciente*" required>
        </div>
        <div class="input-container">
          <label class="roboto-regular">Data de nascimento</label>
          <input type="date" class="roboto-regular" name="paciente_dt" placeholder="Data de nascimento*" required>
        </div>
        <div class="input-container">
          <label class="roboto-regular">Sexo</label>
          <select id="paciente_sexo" name="paciente_sexo">
            <option value="m">Masculino</option>
            <option value="f">Feminino</option>
          </select>
        </div>
        <div class="input-container">
          <label class="roboto-regular">Email</label>
          <input type="email" class="roboto-regular" name="paciente_email" placeholder="Email*" required>
        </div>
        <div class="input-container">
          <label class="roboto-regular">Senha</label>
          <input type="password" class="roboto-regular" name="paciente_senha" placeholder="Senha*" required>
        </div>
        <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
        <button type="submit" class="sign-up-btn-modal poppins-semibold c01">Cadastrar</button>
      </form>

      <form method="post" action="/clinic_management/auth/register_medico.php">
        <h2 class="form-title poppins-semibold c11">Cadastrar Médico</h2>
        <div class="input-container">
          <label class="roboto-regular">Nome do médico</label>
          <input type="text" class="roboto-regular" name="medico_name" placeholder="Nome do médico*" required>
        </div>
        <div class="input-container">
          <label class="roboto-regular">Especialidade</label>
          <input type="text" class="roboto-regular" name="medico_especialidade" placeholder="Especialidade*" required>
        </div>
        <div class="input-container">
          <label class="roboto-regular">CRM</label>
          <input type="text" class="roboto-regular" name="medico_crm" placeholder="CRM*" required>
        </div>
        <div class="input-container">
          <label class="roboto-regular">Email</label>
          <input type="email" class="roboto-regular" name="medico_email" placeholder="Email*" required>
        </div>
        <div class="input-container">
          <label class="roboto-regular">Senha</label>
          <input type="password" class="roboto-regular" name="medico_senha" placeholder="Senha*" required>
        </div>
        <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
        <button type="submit" class="sign-up-btn-modal poppins-semibold c01">Cadastrar</button>
      </form>
    </div>

    <div>
      <div class="header-tables">
        <h3 class="poppins-semibold c11">Lista de Usuários</h3>
        <div class="tables-change-btns">
          <button class="poppins-semibold c01 active">Pacientes</button>
          <button class="poppins-semibold c01">Médicos</button>
          <button class="poppins-semibold c01">Consultas</button>
        </div>
      </div>
      <table class="tab active">
        <thead>
          <tr class="c01 poppins-medium">
            <th class="first">#</th>
            <th>Tipo</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Data Nasc.</th>
            <th>Sexo</th>
            <th class="last">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pacientes as $paciente) : ?>
            <tr class="registro roboto-regular">
              <td><?php echo htmlspecialchars($paciente['id']); ?></td>
              <td><?php echo htmlspecialchars($paciente['tipo']); ?></td>
              <td><?php echo htmlspecialchars($paciente['nome']); ?></td>
              <td><?php echo htmlspecialchars($paciente['email']); ?></td>
              <td><?php echo htmlspecialchars($paciente['data_nascimento']); ?></td>
              <td><?php echo htmlspecialchars($paciente['sexo']); ?></td>
              <td>
                <form class="form-delete-table" method="post" action="/clinic_management/auth/delete_paciente.php" onsubmit="return confirm('Você tem certeza que deseja excluir este paciente?');">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($paciente['id']); ?>">
                  <button class="roboto-regular c11" type="submit">Excluir</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <table class="tab">
        <thead>
          <tr class="c01 poppins-medium">
            <th class="first">#</th>
            <th>Tipo</th>
            <th>Nome</th>
            <th>Email</th>
            <th>CRM</th>
            <th>Especialidade</th>
            <th class="last">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($medicos as $medico) : ?>
            <tr class="registro roboto-regular">
              <td><?php echo htmlspecialchars($medico['id']); ?></td>
              <td><?php echo htmlspecialchars($medico['tipo']); ?></td>
              <td><?php echo htmlspecialchars($medico['nome']); ?></td>
              <td><?php echo htmlspecialchars($medico['email']); ?></td>
              <td><?php echo htmlspecialchars($medico['crm']); ?></td>
              <td><?php echo htmlspecialchars($medico['especialidade']); ?></td>
              <td>
                <form class="form-delete-table" method="post" action="/clinic_management/auth/delete_medico.php" onsubmit="return confirm('Você tem certeza que deseja excluir este médico?');">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($medico['id']); ?>">
                  <button class="roboto-regular c11" type="submit">Excluir</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <table class="tab">
        <thead>
          <tr class="c01 poppins-medium">
            <th class="first">#</th>
            <th>Data</th>
            <th>Horário</th>
            <th>Médico</th>
            <th>Paciente</th>
            <th class="last">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($consultas as $consulta) : ?>
            <tr class="registro roboto-regular">
              <td><?php echo htmlspecialchars($consulta['id']); ?></td>
              <td><?php echo htmlspecialchars($consulta['data_consulta']); ?></td>
              <td><?php echo htmlspecialchars($consulta['horario_consulta']); ?></td>
              <td><?php echo htmlspecialchars($consulta['medico_crm']); ?></td>
              <td><?php echo htmlspecialchars($consulta['paciente_email']); ?></td>
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

  <div id="modal" class="modal-container">
    <div class="modal-box">
      <h2 class="modal-title poppins-semibold">Agendar Consulta</h2>
      <div class="modal-content">
        <form method="post" action="/clinic_management/auth/create_consulta.php">
          <div class="input-container">
            <label class="roboto-regular">Paciente Email</label>
            <input type="text" class="roboto-regular" name="paciente_email" placeholder="Paciente Email*" required>
          </div>
          <div class="input-container">
            <label class="roboto-regular">Médico CRM</label>
            <input type="number" class="roboto-regular" name="medico_crm" placeholder="Medico CRM*" required>
          </div>
          <div class="input-container">
            <label class="roboto-regular">Data</label>
            <input type="date" class="roboto-regular" name="data" placeholder="Data*" required>
          </div>
          <div class="input-container">
            <label class="roboto-regular">Horário</label>
            <input type="time" class="roboto-regular" name="horario" placeholder="Horário*" required>
          </div>
          <input type="hidden" name="clinica_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">
          <button type="submit" class="sign-up-btn-modal poppins-semibold c01">Cadastrar</button>
        </form>
      </div>
    </div>
  </div>

  <script type="module" src="../public/scripts/main.js"></script>

</body>

</html>