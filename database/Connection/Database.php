<?php
namespace Database;

use KissPhp\Services\Dotenv;


class Database {
  private string $host;
  private string $port;
  private string $dbname;
  private string $user;
  private string $password;

  public function __construct() {
    $this->host = Dotenv::get('DB_HOST') ?? '';
    $this->port = Dotenv::get('DB_PORT') ?? '';
    $this->dbname = Dotenv::get('DB_NAME') ?? '';
    $this->user = Dotenv::get('DB_USER') ?? '';
    $this->password = Dotenv::get('DB_PASSWORD') ?? '';
  }

  public function getConnection(): \PDO {
    static $conection;

    if ($conection === null) {
      $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}";
      $conection = new \PDO($dsn, $this->user, $this->password);
    }

    return $conection;
  }
}
