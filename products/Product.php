<?php

include '../database/Database.php';

header('Content-type: application/json; charset=UTF-8');

class Product extends Data implements Functions
{
    public function createTable()
    {
        // connection to database
        $this->initialize();

        $table = "CREATE TABLE IF NOT EXISTS products(
            id int primary key auto_increment,
            core_items varchar(199) not null,
            accessories varchar(199) not null,
            package varchar(199) not null,
            brands varchar(199),
            warranty varchar(199)
            )";

        // initialize to create the product table
        $this->conn->query($table);
    }

    public function getAll()
    {
        $products = $this->conn->query("SELECT * FROM products");

        return json_encode($products->fetch_all(MYSQLI_ASSOC)); 
    }

    public function create($params)
    {
        // validation
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            return json_encode([
                "code" => 201,
                "message" => 'Only Post Method is Allowed',
            ]);
        }

        if(!isset($params['core_items']) || empty($params['core_items'])){
            return json_encode([
                "code" => 422,
                "message" => 'Core Items is required',
            ]);
        }

        if(!isset($params['accessories']) || empty($params['accessories'])){
            return json_encode([
                "code" => 422,
                "message" => 'Accessories is required',
            ]);
        }

        if(!isset($params['package']) || empty($params['package'])){
            return json_encode([
                "code" => 422,
                "message" => 'Package is required',
            ]);
        }

        if(!isset($params['brands']) || empty($params['brands'])){
            return json_encode([
                "code" => 422,
                "message" => 'Brands is required',
            ]);
        }

        if(!isset($params['warranty']) || empty($params['warranty'])){
            return json_encode([
                "code" => 422,
                "message" => 'Warranty is required',
            ]);
        }

        $core_items = $params['core_items'];
        $accessories = $params['accessories'];
        $package = $params['package'];
        $brands = $params['brands'];
        $warranty = $params['warranty'];

        $sql = "INSERT INTO products(core_items, accessories, package, brands, warranty) 
                VALUES('$core_items', '$accessories', '$package', '$brands', '$warranty')";

        $isAdded = $this->conn->query($sql);

        if($isAdded) {
            return json_encode([
                "code" => 201,
                "message" => 'Product has been successfully added',
            ]);
        } else {
            return json_encode([
                "code" => 500,
                "message" => $this->getError(),
            ]);
        }
    }

    public function update($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            return json_encode([
                "code" => 201,
                "message" => 'Only Post Method is Allowed',
            ]);
        }

        if(!isset($params['core_items']) || empty($params['core_items'])){
            return json_encode([
                "code" => 422,
                "message" => 'Core Items is required',
            ]);
        }

        if(!isset($params['accessories']) || empty($params['accessories'])){
            return json_encode([
                "code" => 422,
                "message" => 'Accessories is required',
            ]);
        }

        if(!isset($params['package']) || empty($params['package'])){
            return json_encode([
                "code" => 422,
                "message" => 'Package is required',
            ]);
        }

        if(!isset($params['brands']) || empty($params['brands'])){
            return json_encode([
                "code" => 422,
                "message" => 'Brands is required',
            ]);
        }

        if(!isset($params['warranty']) || empty($params['warranty'])){
            return json_encode([
                "code" => 422,
                "message" => 'Warranty is required',
            ]);
        }

        if(!isset($params['id']) || empty($params['id'])){
            return json_encode([
                "code" => 422,
                "message" => 'ID is required',
            ]);
        }

        $id = $params['id'];
        $core_items = $params['core_items'];
        $accessories = $params['accessories'];
        $package = $params['package'];
        $brands = $params['brands'];
        $warranty = $params['warranty'];

        $sql = "UPDATE products SET core_items = '$core_items', accessories = '$accessories', package = '$package', brands ='$brands', warranty = '$warranty'
                where id = '$id'";
        
        $isUpdated = $this->conn->query($sql);

        if($isUpdated) {
            return json_encode([
                "code" => 201,
                "message" => 'Product has been successfully updated',
            ]);
        } else {
            return json_encode([
                "code" => 500,
                "message" => $this->getError(),
            ]);
        }
    }

    public function delete($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET'){
            return json_encode([
                "code" => 201,
                "message" => 'Only GET Method is Allowed',
            ]);
        }
    
        if(!isset($params['id']) || empty($params['id'])){
            return json_encode([
                "code" => 422,
                "message" => 'ID is required',
            ]);
        }

        $id = $params['id'];

        $sql = "DELETE FROM products where id = '$id'";
        
        $isDeleted = $this->conn->query($sql);

        if($isDeleted) {
            return json_encode([
                "code" => 201,
                "message" => 'Product has been successfully deleted',
            ]);
        } else {
            return json_encode([
                "code" => 500,
                "message" => $this->getError(),
            ]);
        }
    }

    public function getRecord($params)
    {
        if($_SERVER['REQUEST_METHOD'] !='GET') {
            $response = [
                "code" => 422,
                "message" => $_SERVER ['REQUEST_METHOD'] . 'Only the GET Method is allowed',
            ];

            return json_encode($response);
        }

        //validate if id empty
        if(!isset($params['id']) || empty($params['id'])) {
            $response = [
                "code" => 422,
                "message" => 'ID will be required',
            ];

            return json_encode($response);
        }

        //id from url
        $id = $params['id'];

        $data = $this->conn->query("SELECT * FROM products where id = '$id'");

        //check if no data has been retrieve
        if($data->num_rows == 0) {
            $response = [
                "code" => 404,
                "message" => 'NO product has found',
            ];

            return json_encode($response);
        }

        //return to json data
        return json_encode($data->fetch_assoc());
    }

    public function search($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET'){
            return json_encode([
                "code" => 201,
                "message" => 'Only GET Method is Allowed',
            ]);
        }

        $core_items = $params['core_items'] ?? '';

        $sql = "SELECT * FROM products where core_items like '%$core_items%'";

        $product = $this->conn->query($sql);

        if(empty($this->getError())) {
            return json_encode($product->fetch_all(MYSQLI_ASSOC));
        } else {
            return json_encode([
                "code" => 500,
                "message" => $this->getError(),
            ]);
        }
    }

}

?>