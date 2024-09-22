<?php
require_once 'User.php';

class Consulta
{
  public $medicoCRM;
  public $pacienteEmail;
  public $data;
  public $horario;
  public $clinicaId;

  public function __construct($pacienteEmail, $medicoCRM, $data, $horario, $clinicaId)
  {
    $this->pacienteEmail = $pacienteEmail;
    $this->medicoCRM = $medicoCRM;
    $this->data = $data;
    $this->horario = $horario;
    $this->clinicaId = $clinicaId;
  }

  public function create()
  {
    try {
      $conn = Database::getHefestos();
      $consulta = [
        'paciente_email' => $this->pacienteEmail,
        'medico_crm' => $this->medicoCRM,
        'data_consulta' => $this->data,
        'horario_consulta' => $this->horario,
        'clinica_id' => $this->clinicaId
      ];
      $conn->tabela('consulta')->insert($consulta);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }

  public function delete($id)
  {
    try {
      $conn = Database::getHefestos();
      $conn->tabela('consulta')->delete(['id' => $id]);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }

  public function getAll($clinicaId)
  {
    try {
      $conn = Database::getConn();
      $stmt = $conn->prepare("SELECT * FROM consulta WHERE clinica_id = ?");
      $stmt->execute([$clinicaId]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }
}
