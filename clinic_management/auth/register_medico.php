<?php
session_start(); // Inicie a sessão no topo do arquivo

require_once '../config/Database.php';
require_once '../classes/Medico.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $medicoName = filter_input(INPUT_POST, 'medico_name');
    $medicoEmail = filter_input(INPUT_POST, 'medico_email');
    $medicoEspecialidade = filter_input(INPUT_POST, 'medico_especialidade');
    $medicoCRM = filter_input(INPUT_POST, 'medico_crm');
    $medicoPassword = $_POST['medico_senha'];
    $clinicaId = filter_input(INPUT_POST, 'clinica_id');

    // Verifique se $adminName está definido na sessão
    $adminName = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : null;

    if ($medicoName && $medicoEmail && $medicoEspecialidade && $medicoPassword) {
        $medico = new Medico($medicoName, $medicoEmail, $medicoEspecialidade, $medicoCRM, $medicoPassword, $clinicaId);
        $medico->cadastrar();

        // Redirecione, assegurando que $adminName está definido
        header('Location: /clinic_management/views/adminView.php?adminName=' . urlencode($adminName));
        exit(); // Adicione exit após o redirecionamento
    } else {
        die("Error: All fields are required.");
    }
}
