<?php

class DataBase
{
    private $host = "localhost";
    private $port = 3306;

    private $dbname = "job4you";
    private $user = "root";
    private $password = "";
    
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli(
            hostname: $this->host,
            database: $this->dbname,
            username: $this->user,
            password: $this->password,
            port: $this->port
        );

        if ($this->conn->connect_error) {
            die("Falha na conexão com o banco de dados: {$this->conn->connect_error}");
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function closeConnection()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}