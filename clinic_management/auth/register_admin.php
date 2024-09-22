<?php
require_once '../config/Database.php';
require_once '../classes/AdminPadrao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $adminName = filter_input(INPUT_POST, 'user_name');
  $adminEmail = filter_input(INPUT_POST, 'user_email');
  $adminPassword = $_POST['user_senha'];
  $clinicaId = filter_input(INPUT_POST, 'clinica_id');

  if ($adminName && $adminEmail && $adminPassword && $clinicaId) {
    $admin = new AdminPadrao($adminName, $adminEmail, $adminPassword, $clinicaId);
    $admin->cadastrar();
    header('Location: /clinic_management/views/adminMasterView.php?clinicName=' . urlencode($_SESSION['nome']));
  } else {
    die("Error: All fields are required.");
  }
}