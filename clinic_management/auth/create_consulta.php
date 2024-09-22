<?php
require_once '../config/Database.php';
require_once '../classes/Consulta.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $pacienteEmail = filter_input(INPUT_POST, 'paciente_email');
  $medicoCRM = filter_input(INPUT_POST, 'medico_crm');
  $data = filter_input(INPUT_POST, 'data');
  $horario = filter_input(INPUT_POST, 'horario');
  $clinicaId = filter_input(INPUT_POST, 'clinica_id');

  if ($pacienteEmail && $medicoCRM && $data && $horario) {
    $consulta = new Consulta($pacienteEmail, $medicoCRM, $data, $horario, $clinicaId);
    $consulta->create();
    header('Location: /clinic_management/views/adminView.php');
    exit;
  } else {
    die("Error: All fields are required.");
  }
}
