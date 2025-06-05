<?php
require_once '../config/Database.php';
require_once '../classes/Consulta.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $pacienteEmail = filter_input(INPUT_POST, 'paciente_email');
  $medicoCRM = filter_input(INPUT_POST, 'medico_crm');
  $data = filter_input(INPUT_POST, 'data');
  $horario = filter_input(INPUT_POST, 'horario');
  $clinicaId = filter_input(INPUT_POST, 'clinica_id');

  // Validação dos campos obrigatórios
  if (!$pacienteEmail || !$medicoCRM || !$data || !$horario) {
    die("Erro: Todos os campos são obrigatórios.");
  }

  // Validação para não permitir datas anteriores
  if (strtotime($data) < strtotime(date('Y-m-d'))) {
    die("Erro: Não é permitido agendar consultas para datas anteriores a hoje.");
  }

  // Criação da consulta
  try {
    $consulta = new Consulta($pacienteEmail, $medicoCRM, $data, $horario, $clinicaId);
    $consulta->create();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  } catch (Exception $e) {
    die("Erro ao criar consulta: " . $e->getMessage());
  }
}