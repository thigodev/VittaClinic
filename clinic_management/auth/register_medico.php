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

    if ($medicoName && $medicoEmail && $medicoEspecialidade && $medicoPassword) {
        $medico = new Medico($medicoName, $medicoEmail, $medicoEspecialidade, $medicoCRM, $medicoPassword, $clinicaId);
        $medico->cadastrar();

        // Exiba uma mensagem de sucesso (opcional)
        $_SESSION['success_message'] = "Médico cadastrado com sucesso!";
    } else {
        // Exiba uma mensagem de erro (opcional)
        $_SESSION['error_message'] = "Erro: Todos os campos são obrigatórios.";
    }
}

// Recarregue a página atual para limpar o formulário
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();