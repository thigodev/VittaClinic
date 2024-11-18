<?php
session_start(); // Inicie a sessão no topo do arquivo

require_once '../config/Database.php';
require_once '../classes/Paciente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pacienteName = filter_input(INPUT_POST, 'paciente_name');
    $pacienteEmail = filter_input(INPUT_POST, 'paciente_email');
    $pacienteDt = filter_input(INPUT_POST, 'paciente_dt');
    $pacienteSexo = filter_input(INPUT_POST, 'paciente_sexo');
    $pacientePassword = $_POST['paciente_senha'];
    $clinicaId = filter_input(INPUT_POST, 'clinica_id');

    // Verifique se $adminName está definido a partir da sessão
    $adminName = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : null;

    if ($pacienteName && $pacienteEmail && $pacienteDt && $pacienteSexo && $pacientePassword) {
        $paciente = new Paciente($pacienteName, $pacienteEmail, $pacienteDt, $pacienteSexo, $pacientePassword, $clinicaId);
        $paciente->cadastrar();

        // Redirecione com segurança, assegurando que $adminName está definido
        header('Location: /clinic_management/views/adminPatientsView.php?adminName=' . urlencode($adminName));
        exit(); // Adicione exit para garantir que o script pare após o redirecionamento
    } else {
        die("Error: All fields are required.");
    }
}

