<?php

class Database
{
    protected $conn;
    protected $db = "defense";

    public function init()
    {
        $this->conn = new mysqli("localhost", "root", "");
        $this->conn->query("CREATE DATABASE IF NOT EXISTS $this->db");
        $this->conn = new mysqli("localhost", "root", "", $this->db);
    }
}