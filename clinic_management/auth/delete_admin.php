<?php
require_once '../config/Database.php';
require_once '../classes/AdminPadrao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  if ($id) {
    $admin = new AdminPadrao(null, null, null, null);
    $admin->delete($id);
    header('Location: /clinic_management/views/adminMasterView.php?adminName=' . urlencode($adminName));
  } else {
    header('Location: /clinic_management/views/adminMasterView.php?adminName=' . urlencode($adminName) . '&error=invalid_id');
  }
}