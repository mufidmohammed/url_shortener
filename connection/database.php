<?php

class Database
{
    private $host = 'localhost';
    private $db_name = 'shorten_url';
    private $username = 'root';
    private $password = '';

    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
        // $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        
        // if ($this->conn->connect_error) {
        //     die("Connection failed. " . $this->conn->connect_error);
        // }
    }

    public function find(string $table, int $id): array
    {
        try {
            $sql = "SELECT * FROM $table WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return [];
            }
            return $result;
        }
        catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function insert(string $table, array $data): bool
    {
        try {
            $keys = implode(',', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));

            $sql = "INSERT INTO $table ($keys) VALUES ($values)";
            $stmt = $this->conn->prepare($sql);

            foreach($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            return $stmt->execute();
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}

$db = new Database();
