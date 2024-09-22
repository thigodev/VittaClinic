<?php
require_once 'User.php';

class Medico extends User
{

  public $especialidade;
  public $crm;
  public $clinicaId;

  public function __construct($username, $email, $especialidade, $crm, $password, $clinicaId)
  {
    parent::__construct($username, $email, $password, 'Médico');
    $this->especialidade = $especialidade;
    $this->crm = $crm;
    $this->clinicaId = $clinicaId;
  }

  public function cadastrar()
  {
    try {
      $conn = Database::getHefestos();
      $medico = [
        'nome' => $this->username,
        'email' => $this->email,
        'especialidade' => $this->especialidade,
        'crm' => $this->crm,
        'senha' => password_hash($this->password, PASSWORD_BCRYPT),
        'clinica_id' => $this->clinicaId,
        'tipo' => 'Médico'
      ];
      $conn->tabela('medico')->insert($medico);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }

  public function delete($id)
  {
    try {
      $conn = Database::getHefestos();
      $conn->tabela('medico')->delete(['id' => $id]);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }

  public function getAll($clinicaId)
  {
    try {
      $conn = Database::getConn();
      $stmt = $conn->prepare("SELECT * FROM medico WHERE clinica_id = ?");
      $stmt->execute([$clinicaId]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }

  public function getConsultas($crm)
  {
    try {
      $conn = Database::getConn();
      $stmt = $conn->prepare("SELECT * FROM consulta WHERE medico_crm = ?");
      $stmt->execute([$crm]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }
}