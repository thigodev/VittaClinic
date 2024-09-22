<?php
require_once '../config/Database.php';
require_once '../classes/Clinica.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $clinicName = filter_input(INPUT_POST, 'clinic_name');
  $clinicCnpj = filter_input(INPUT_POST, 'clinic_cnpj');
  $clinicEmail = filter_input(INPUT_POST, 'clinic_email');
  $clinicPassword = $_POST['clinic_password'];

  if ($clinicName && $clinicCnpj && $clinicEmail && $clinicPassword) {
    $clinic = new Clinica($clinicName, $clinicEmail, $clinicCnpj, $clinicPassword);
    $clinic->cadastrar();
    header('Location: /clinic_management/views/loginView.php');
    exit();
  } else {
    die("Error: All fields are required.");
  }
}
