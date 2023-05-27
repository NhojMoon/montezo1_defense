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
} 
