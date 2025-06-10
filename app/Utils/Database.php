<?php
namespace App\Utils;

use mysqli;
use KissPhp\Services\Dotenv;
use KissPhp\Services\Dotenv\Env;

class Database {
  private string $host;
  private string $port;
  private string $dbname;
  private string $user;
  private string $password;

  public function __construct() {
    $this->host = Env::get('DB_HOST') ?? '';
    $this->port = (int) Env::get('DB_PORT') ?? '';
    $this->dbname = Env::get('DB_NAME') ?? '';
    $this->user = Env::get('DB_USER') ?? '';
    $this->password = Env::get('DB_PASSWD') ?? '';
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
