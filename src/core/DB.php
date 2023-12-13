<?php

class DB
{
    public $conn;
    public $servername = "localhost:8111";
    public $username = "root";
    public $password = "root";
    public $dbname = "fast_food";


    function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connect Successfully";
        } catch (PDOException $e) {
            echo "Connect failed " . $e->getMessage();
        }
    }
}
