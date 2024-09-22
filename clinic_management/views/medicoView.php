<?php
require_once '../config/Database.php';
require_once '../classes/Paciente.php';
require_once '../classes/Medico.php';
require_once '../classes/Consulta.php';

session_start();

$crm = $_SESSION['crm'];
$clinicaId = $_SESSION['id'];

// var_dump($crm);

$medico = new Medico(null, null, null, null, null, null);
$medicos = $medico->getAll($clinicaId);
$consultas = $medico->getConsultas($crm);

// $paciente = new Paciente(null, null, null, null, null);
// $pacientes = $paciente->getAll();

$medicoName = $_SESSION['nome'];
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
  <title>Clinica - Médico</title>
  <link rel="stylesheet" href="/clinic_management/public/styles/admin_padrao/homepage.css">
</head>

<body>
  <header>
    <img src="/clinic_management/public/midia/img/umbrella-logo-footer.svg">
    <nav class="header-menu-admin">
      <button type="submit" onclick="location.href='logout.php'" class="exit-session-btn poppins-semibold c01">Sair da Conta</button>
    </nav>
  </header>

  <div class="container">
    <h1 class="wellcome-title poppins-semibold c11">Bem vindo, <?php echo htmlspecialchars($medicoName); ?></h1>

    <h3 class="poppins-semibold c11">Lista de consultas</h3>
    <table class="tab active">
      <thead>
        <tr class="c01 poppins-medium">
          <th class="first">#</th>
          <th>Data da Consulta</th>
          <th>Horário</th>
          <th class="last">Paciente</th>
          <!-- <th class="last">Informações</th> -->
        </tr>
      </thead>
      <tbody>
        <?php foreach ($consultas as $consulta) : ?>
        <tr class="registro roboto-regular">
          <td><?php echo htmlspecialchars($consulta['id']); ?></td>
          <td><?php echo htmlspecialchars($consulta['data_consulta']); ?></td>
          <td><?php echo htmlspecialchars($consulta['horario_consulta']); ?></td>
          <td><?php echo htmlspecialchars($consulta['paciente_email']); ?></td>
          <!-- <td>
              <form class="form-delete-table" method="post" action="/clinic_management/auth/readHistory.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($paciente['id']); ?>">
                <button class="roboto-regular c11" type="submit">Histórico</button>
              </form>
            </td> -->
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <script type="module" src="../public/scripts/main.js"></script>

</body>

</html>