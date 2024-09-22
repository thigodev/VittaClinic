<?php
require_once 'User.php';

class Clinica extends User
{

  public $cnpj;

  public function __construct($username, $email, $cnpj, $password)
  {
    parent::__construct($username, $email, $password, 'adminMaster');
    $this->cnpj = $cnpj;
  }

  public function cadastrar()
  {
    try {
      $conn = Database::getHefestos();
      $clinic = ['nome' => $this->username, 'email' => $this->email, 'cnpj' => $this->cnpj, 'senha' => password_hash($this->password, PASSWORD_BCRYPT)];
      $conn->tabela('clinic')->insert($clinic);
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }
  }

  public function getAll($id)
  {
    $conn = Database::getHefestos();
    return $conn->tabela('clinic')->where(['id' => $id])->todos();
  }

  public function delete($id)
  {
    $conn = Database::getHefestos();
    $conn->tabela('clinic')->delete(['id' => $id]);
  }
}