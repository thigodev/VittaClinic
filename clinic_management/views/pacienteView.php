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

// var_dump($_SESSION);

$paciente = new Paciente(null, null, null, null, null, null);
$consultas = $paciente->getConsultas($pacienteEmail);
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
  <title>Clinica - Paciente</title>
  <link rel="stylesheet" href="/clinic_management/public/styles/admin_padrao/homepage.css">
</head>

<body>
  <header>
    <img src="/clinic_management/public/midia/img/umbrella-logo-footer.svg">
    <nav class="header-menu-admin">
      <a href="#" class="open-modal-btn roboto-regular c01">Meu Perfil</a>
      <button type="submit" onclick="location.href='logout.php'" class="exit-session-btn poppins-semibold c01">Sair da Conta</button>
    </nav>
  </header>

  <div class="container">
    <h1 class="wellcome-title poppins-semibold c11">Bem vindo, <?php echo htmlspecialchars($pacienteName); ?></h1>

    <div>
      <div class="header-tables">
        <h3 class="poppins-semibold c11">Suas consultas</h3>
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
          <?php foreach ($consultas as $consulta) : ?>
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

    <div id="modal" class="modal-container">
      <div class="modal-box">
        <h2 class="modal-title perfil-title poppins-semibold">Meu Perfil</h2>
        <div class="info-container">
          <ul>
            <li class="poppins-semibold c11">Nome: <span class="roboto-regular c11"><?php echo htmlspecialchars($pacienteName); ?></span></li>
            <li class="poppins-semibold c11">Email: <span class="roboto-regular c11"><?php echo htmlspecialchars($pacienteEmail); ?></span></li>
            <li class="poppins-semibold c11">Data de nascimento: <span class="roboto-regular c11"><?php echo htmlspecialchars($pacienteDt); ?></span></li>
            <li class="poppins-semibold c11">Sexo: <span class="roboto-regular c11"><?php

                                                                                    if ($pacienteSexo == 'm') {
                                                                                      echo "Masculino";
                                                                                    } else {
                                                                                      echo "Feminino";
                                                                                    }

                                                                                    ?></span></li>
          </ul>
        </div>
        <div class="modal-content">
        </div>
      </div>
    </div>

    <script type="module" src="../public/scripts/main.js"></script>

</body>

</html>