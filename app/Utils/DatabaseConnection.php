<?php
namespace App\Utils;

use mysqli;
use KissPhp\Services\Dotenv;

class DatabaseConnection {
  private string $host;
  private string $port;
  private string $dbname;
  private string $user;
  private string $password;

  public function __construct() {
    $this->host = Dotenv::get('DB_HOST') ?? '';
    $this->port = (int) Dotenv::get('DB_PORT') ?? '';
    $this->dbname = Dotenv::get('DB_NAME') ?? '';
    $this->user = Dotenv::get('DB_USER') ?? '';
    $this->password = Dotenv::get('DB_PASSWD') ?? '';
  }

  public function getConnection(): mysqli {
    static $connection;

    if ($connection === null) {
      $connection = new mysqli(
        $this->host,
        $this->user,
        $this->password,
        $this->dbname,
        $this->port
      );

      if ($connection->connect_error) {
        throw new \Exception("Connection failed: " . $connection->connect_error);
      }
      $connection->set_charset('utf8mb4');
    }
    return $connection;
  }
}
