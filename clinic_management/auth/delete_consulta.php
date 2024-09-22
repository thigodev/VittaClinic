<?php
require_once '../config/Database.php';
require_once '../classes/Consulta.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  if ($id) {
    $consulta = new Consulta(null, null, null, null, null);
    $consulta->delete($id);
    header('Location: /clinic_management/views/adminView.php?adminName=' . urlencode($adminName));
  } else {
    header('Location: /clinic_management/views/adminView.php?adminName=' . urlencode($adminName) . '&error=invalid_id');
  }
}
