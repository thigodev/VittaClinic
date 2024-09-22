<?php
require_once '../config/Database.php';
require_once '../classes/Medico.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $medicoName = filter_input(INPUT_POST, 'medico_name');
  $medicoEmail = filter_input(INPUT_POST, 'medico_email');
  $medicoEspecialidade = filter_input(INPUT_POST, 'medico_especialidade');
  $medicoCRM = filter_input(INPUT_POST, 'medico_crm');
  $medicoPassword = $_POST['medico_senha'];
  $clinicaId = filter_input(INPUT_POST, 'clinica_id');

  if ($medicoName && $medicoEmail && $medicoEspecialidade && $medicoPassword) {
    $medico = new Medico($medicoName, $medicoEmail, $medicoEspecialidade, $medicoCRM, $medicoPassword, $clinicaId);
    $medico->cadastrar();
    header('Location: /clinic_management/views/adminView.php?adminName=' . urlencode($adminName));
  } else {
    die("Error: All fields are required.");
  }
}