<?php
abstract class User
{
  protected $username;
  protected $email;
  protected $password;

  public function __construct($username, $email, $password)
  {
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
  }

  public abstract function cadastrar();

  public abstract function delete($id);

  public abstract function getAll($clinicaId);
}