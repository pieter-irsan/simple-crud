<?php
class Database
{
    private $host = "localhost";
    private $dbName = "practice";
    private $userName = "root";
    private $password = "";
    private $conn;

    public function getConnection(){
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->userName, $this->password);
            $this->conn->exec("set names utf*");
        } catch (PDOException $exception) {
            echo "Connection Error : " . $exception->getMessage();
        } return $this-conn;
    }
}