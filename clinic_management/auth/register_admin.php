<?php
session_start(); // Inicie a sessão

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

        // Verifique se $_SESSION['nome'] está definida
        if (isset($_SESSION['nome'])) {
            header('Location: /clinic_management/views/adminMasterView.php?clinicName=' . urlencode($_SESSION['nome']));
            exit(); // Adicione exit para garantir que não haverá mais saída
        } else {
            die("Error: Clinic name is not set in session.");
        }
    } else {
        die("Error: All fields are required.");
    }
}
