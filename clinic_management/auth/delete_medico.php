<?php
require_once '../config/Database.php';
require_once '../classes/Medico.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
  if ($id) {
    $medico = new Medico(null, null, null, null, null, null);
    $medico->delete($id);
    header('Location: /clinic_management/views/adminView.php?adminName=' . urlencode($adminName));
  } else {
    header('Location: /clinic_management/views/adminView.php?adminName=' . urlencode($adminName) . '&error=invalid_id');
  }
}