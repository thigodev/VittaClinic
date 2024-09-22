<?php
require_once 'User.php';

class AdminPadrao extends User
{
  public $clinicaId;

  public function __construct($username, $email, $password, $clinicaId)
  {
    parent::__construct($username, $email, $password);
    $this->clinicaId = $clinicaId;
  }

  public function cadastrar()
  {
    try {
      $conn = Database::getHefestos();
      $admin = [
        'nome' => $this->username,
        'email' => $this->email,
        'senha' => password_hash($this->password, PASSWORD_BCRYPT),
        'clinica_id' => $this->clinicaId
      ];
      $conn->tabela('admin')->insert($admin);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }

  public function delete($id)
  {
    try {
      $conn = Database::getHefestos();
      $conn->tabela('admin')->delete(['id' => $id]);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }

  public function getAll($clinicaId)
  {
    try {
      $conn = Database::getConn();
      $stmt = $conn->prepare("SELECT * FROM `admin` WHERE clinica_id = ?");
      $stmt->execute([$clinicaId]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }
}