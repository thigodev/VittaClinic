<?php
session_start(); // Inicie a sessão no topo do arquivo

require_once '../config/Database.php';
require_once '../classes/Consulta.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    // Verifique se $adminName está definido a partir da sessão
    $adminName = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : null;

    if ($id) {
        $consulta = new Consulta(null, null, null, null, null);
        $consulta->delete($id);
        
        // Redirecionamento, assegurando que $adminName está definido
        header('Location: /clinic_management/views/adminView.php?adminName=' . urlencode($adminName));
        exit(); // Adicione exit após o redirecionamento
    } else {
        // Redirecionamento em caso de ID inválido
        header('Location: /clinic_management/views/adminView.php?adminName=' . urlencode($adminName) . '&error=invalid_id');
        exit(); // Adicione exit após o redirecionamento
    }
}

