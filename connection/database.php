<?php

define('ROOT', dirname(dirname(__FILE__)));

require_once(ROOT . '/config.php');

class Database
{
    private $host;
    private $db_name;
    private $username;
    private $password;

    public $conn;

    public function __construct()
    {
        $this->host = DB_HOST;
        $this->username = DB_USER;
        $this->password = DB_PASSWORD;
        $this->db_name = DB_NAME;

        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
    }

}

$db = new Database();
