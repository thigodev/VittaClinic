<?php

class Database
{
  private static $instance;

  public static function getConn()
  {
    if (!isset(self::$instance)) {
      self::$instance = new \PDO('mysql:host=localhost;dbname=umbrella1', 'root', '');
    }
    return self::$instance;
  }

  public static function getHefestos()
  {
    require_once '../../HefestosORM.php';
    $config = ['driver' => 'mysql',
              'host' => 'localhost',
              'nome_db' => 'umbrella1',
              'usuario' => 'root',
              'senha' => '',
            ];

    return HefestosORM::instancia($config);
  }
}
