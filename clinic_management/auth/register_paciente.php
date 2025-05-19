<?php
session_start();

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
        $_SESSION['success_message'] = "Paciente cadastrado com sucesso!";
    } else {
        $_SESSION['error_message'] = "Erro: Todos os campos são obrigatórios.";
    }
}
// Não há redirecionamento nem exit aqui!