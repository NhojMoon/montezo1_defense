<?php

include '../polymorp.php';

class Data extends Database
{
    protected $conn;
    private $server = "localhost";
    protected $dbname = "project";

    public function initialize()
    {
        $this->conn = new mysqli($this->server, "root", "");
        $this->conn->query("CREATE DATABASE IF NOT EXISTS $this->dbname");
        $this->conn = new mysqli($this->server, "root", "", $this->dbname);
    }

    public function getError()
    {
        return $this->conn->error;
    }

}
