<?php

class Database
{
  private static $instance;

  public static function getConn()
  {
    if (!isset(self::$instance)) {
      self::$instance = new \PDO('mysql:host=db;dbname=vitta1', 'admvitta', '123');
    }
    return self::$instance;
  }

  public static function getHefestos()
  {
    require_once '../../HefestosORM.php';
    $config = ['driver' => 'mysql',
              'host' => 'db',
              'nome_db' => 'vitta1',
              'usuario' => 'admvitta',
              'senha' => '123',
            ];

    return HefestosORM::instancia($config);
  }
}
