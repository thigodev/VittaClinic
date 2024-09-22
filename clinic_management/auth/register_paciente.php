<?php
require_once '../config/Database.php';
require_once '../classes/Paciente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $pacienteName = filter_input(INPUT_POST, 'paciente_name');
  $pacienteEmail = filter_input(INPUT_POST, 'paciente_email');
  $pacienteDt = filter_input(INPUT_POST, 'paciente_dt');
  $pacienteSexo = filter_input(INPUT_POST, 'paciente_sexo');
  $pacientePassword = $_POST['paciente_senha'];
  $clinicaId = filter_input(INPUT_POST, 'clinica_id');

  if ($pacienteName && $pacienteEmail && $pacienteDt && $pacienteSexo && $pacientePassword) {
    $paciente = new Paciente($pacienteName, $pacienteEmail, $pacienteDt, $pacienteSexo, $pacientePassword, $clinicaId);
    $paciente->cadastrar();
    header('Location: /clinic_management/views/adminView.php?adminName=' . urlencode($adminName));
  } else {
    die("Error: All fields are required.");
  }
}
