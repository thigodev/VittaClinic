<?php
require_once 'User.php';

class Paciente extends User
{

  public $age;
  public $sexo;
  public $clinicaId;

  public function __construct($username, $email, $age, $sexo, $password, $clinicaId)
  {
    parent::__construct($username, $email, $password, 'paciente');
    $this->age = $age;
    $this->sexo = $sexo;
    $this->clinicaId = $clinicaId;
  }

  public function cadastrar()
  {
    try {
      $conn = Database::getHefestos();
      $paciente = [
        'nome' => $this->username,
        'email' => $this->email,
        'data_nascimento' => $this->age,
        'sexo' => $this->sexo,
        'senha' => password_hash($this->password, PASSWORD_BCRYPT),
        'clinica_id' => $this->clinicaId,
        'tipo' => 'Paciente'
      ];
      $conn->tabela('paciente')->insert($paciente);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }

  public function delete($id)
  {
    try {
      $conn = Database::getHefestos();
      $conn->tabela('paciente')->delete(['id' => $id]);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }

  public function getAll($clinicaId)
  {
    try {
      $conn = Database::getConn();
      $stmt = $conn->prepare("SELECT * FROM paciente WHERE clinica_id = ?");
      $stmt->execute([$clinicaId]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }

  public function getConsultas($email)
  {
    try {
      $conn = Database::getConn();
      $stmt = $conn->prepare("SELECT * FROM consulta WHERE paciente_email = ?");
      $stmt->execute([$email]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }
}