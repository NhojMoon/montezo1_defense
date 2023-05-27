<?php

include "data.php";

class Product extends Database
{
    public $tblName = "products";

    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS $this->tblName(
            id int auto_increment primary key,
            brand_name varchar(255),
            price float(5),
            description varchar(255)
            )";

        $this->init();
        $this->conn->query($sql);
    }

    public function insert(array $param)
    {
        $brand = $param['brand'];
        $price = $param['price'];
        $description = $param['description'];

        $insert = "INSERT INTO $this->tblName values(null,'$brand','$price','$description')";

        return $this->conn->query($insert);
    }

    public function getAll()
    {
        $all = "SELECT * FROM $this->tblName order by id desc";

        return $this->conn->query($all);
    }
}

