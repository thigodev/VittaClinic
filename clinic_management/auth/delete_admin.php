<?php
require_once '../config/Database.php';
require_once '../classes/AdminPadrao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    // Você pode definir $adminName aqui, se necessário
    // $adminName = 'Nome do Admin'; // Exemplo, altere conforme necessário

    if ($id) {
        $admin = new AdminPadrao(null, null, null, null);
        $admin->delete($id);
        
        // Se você não tiver $adminName definido, remova ou defina-o
        header('Location: /clinic_management/views/adminMasterView.php'); // Remover adminName se não estiver definido
        exit(); // Adicione exit após header
    } else {
        // Se $adminName não estiver definido, remova-o ou trate-o
        header('Location: /clinic_management/views/adminMasterView.php?error=invalid_id');
        exit(); // Adicione exit após header
    }
}
