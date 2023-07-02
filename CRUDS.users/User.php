<?php

include '../database/Database.php';

header("Content-type: application/json; charset=UTF-8");

class User extends Data implements Functions
{

    public $tblName = "users";

    public function createTable()
    {
        $this->initialize();
        
        $table = "CREATE TABLE IF NOT EXISTS $this->tblName(
            id int primary key auto_increment,
            username varchar(50) not null,
            password varchar(50) not null,
            sex varchar(50) not null,
            age int not null,
            address varchar(50) not null,
            nationality varchar(50) not null
            )";

        $this->conn->query($table);      
            
    }

    public function getAll()
    {
        $user = $this->conn->query("SELECT * FROM $this->tblName");

        return json_encode($user->fetch_all(MYSQLI_ASSOC));
    }

    public function create($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            return json_encode([
                "code" => 201,
                "message" => 'Only Post Method is Allowed',
            ]);
        }

        if(!isset($params['username']) || empty($params['username'])) {
            return json_encode([
                "code" => 422,
                "message" => 'Username is required',
            ]);
        }

        if(!isset($params['password']) || empty($params['password'])) {
            return json_encode([
                "code" => 422,
                "message" => 'Password is required',
            ]);
        }

        if(!isset($params['sex']) || empty($params['sex'])) {
            return json_encode([
                "code" => 422,
                "message" => 'Sex is required',
            ]);
        }

        if(!isset($params['age']) || empty($params['age'])) {
            return json_encode([
                "code" => 422,
                "message" => 'Age is required',
            ]);
        }

        if(!isset($params['address']) || empty($params['address'])) {
            return json_encode([
                "code" => 422,
                "message" => 'Address is required',
            ]);
        }

        if(!isset($params['nationality']) || empty($params['nationality'])) {
            return json_encode([
                "code" => 422,
                "message" => 'Nationality is required',
            ]);
        }

        $username = $params['username'];
        $password = $params['password'];
        $sex = $params['sex'];
        $age = $params['age'];
        $address = $params['address'];
        $nationality = $params['nationality'];

        $sql = "INSERT INTO $this->tblName(id, username, password, sex, age, address, nationality) 
                VALUES(NULL,'$username','$password','$sex','$age','$address','$nationality')";

        $isAdded = $this->conn->query($sql);

        if($isAdded) {
            return json_encode([
                "code" => 201,
                "message" => 'User has been successfully added',
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
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            return json_encode([
                "code" => 201,
                "message" => 'Only Post Method is Allowed',
            ]);
        }

        if(!isset($params['username']) || empty($params['username'])) {
            return json_encode([
                "code" => 422,
                "message" => 'Username is required',
            ]);
        }

        if(!isset($params['password']) || empty($params['password'])) {
            return json_encode([
                "code" => 422,
                "message" => 'Password is required',
            ]);
        }

        if(!isset($params['sex']) || empty($params['sex'])) {
            return json_encode([
                "code" => 422,
                "message" => 'Sex is required',
            ]);
        }

        if(!isset($params['age']) || empty($params['age'])) {
            return json_encode([
                "code" => 422,
                "message" => 'Age is required',
            ]);
        }

        if(!isset($params['address']) || empty($params['address'])) {
            return json_encode([
                "code" => 422,
                "message" => 'Address is required',
            ]);
        }

        if(!isset($params['nationality']) || empty($params['nationality'])) {
            return json_encode([
                "code" => 422,
                "message" => 'Nationality is required',
            ]);
        }

        if(!isset($params['id']) || empty($params['id'])) {
            return json_encode([
                "code" => 422,
                "message" => 'ID is required',
            ]);
        }

        $id = $params['id'];
        $username = $params['username'];
        $password = $params['password'];
        $sex = $params['sex'];
        $age = $params['age'];
        $address = $params['address'];
        $nationality = $params['nationality'];

        $sql = "UPDATE $this->tblName SET username = '$username', password = '$password', sex = '$sex', age = '$age', address = '$address', nationality = '$nationality'
                where id = '$id'";
        
        $isUpdated = $this->conn->query($sql);

        if($isUpdated) {
            return json_encode([
                "code" => 201,
                "message" => 'Users has been successfully updated',
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

        $sql = "DELETE FROM $this->tblName where id = '$id'";
        
        $isDeleted = $this->conn->query($sql);

        if($isDeleted) {
            return json_encode([
                "code" => 201,
                "message" => 'Users has been successfully deleted',
            ]);
        } else {
            return json_encode([
                "code" => 500,
                "message" => $this->getError(),
            ]);
        }
    }

    public function search($params)
    {

        if($_SERVER['REQUEST_METHOD'] != 'GET') {
            return json_encode([
       'code'=> 'GET METHOD IS REQUIRED',
        ]);
        }

        if(isset($params['username']) || empty($params['username'])) {
            $search = $params['username'] ?? '';
        }

        if(isset($params['password']) || empty($params['password'])) {
            $search .= $params['password'] ?? '';
        }

        if(isset($params['sex']) || empty($params['sex'])) {
            $search .= $params['sex'] ?? '';
        }

        if(isset($params['age']) || empty($params['age'])) {
            $search .= $params['age'] ?? '';
        }

        if(isset($params['address']) || empty($params['address'])) {
            $search .= $params['address'] ?? '';
        }

        if(isset($params['nationality']) || empty($params['nationality'])) {
            $search .= $params['nationality'] ?? '';
        }

        $sql = "SELECT * FROM $this->tblName WHERE username LIKE '%$search%' OR password LIKE '%$search%' OR sex LIKE '%$search%' 
                OR age LIKE '%$search%' OR address LIKE '%$search%'
                OR nationality LIKE '%$search%'";

        $user = $this->conn->query($sql);

        if(empty($this->getError())) {

            return json_encode($user->fetch_all(MYSQLI_ASSOC));

        } else {

            return json_encode([
                    'code' => 500,
                    'message' => $this->getError(), 
                ]);
        }
       
        $user = $this->conn->query($sql);

            if(empty($this->getError())) {

                return json_encode($user->fetch_all(MYSQLI_ASSOC));

            } else {
                return json_encode([
                    'code' => 500,
                    'message' => $this->getError(), 
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

        //to look id from url
        $id = $params['id'];

        $data = $this->conn->query("SELECT * FROM $this->tblName where id = '$id'");

        //it is to check if no data has been retrieve
        if($data->num_rows == 0) {
            $response = [
                "code" => 404,
                "message" => 'NO Users has found',
            ];

            return json_encode($response);
        }

        return json_encode($data->fetch_assoc());
    }


    public function getId($getid)
    {
        if(!isset($getid['id']) || empty($getid['id'])) {
            $response = [
                'code' => 102,
                'message' => 'Id is required'
            ];

            return json_encode($response);
        }

        $id = $getid['id'];

        $data = $this->conn->query("SELECT * FROM $this->tblName WHERE id='$id'");

        if($data->num_rows == 0)
        {
            $response = [
                "code" => 404,
                "message" => "User Not Found!"
            ];

            return json_encode($response);
        }

        return json_encode($data->fetch_assoc());
    }

    public function authentication()
    {
        if (!isset($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])) {
        echo json_encode([
            'code' => 401,
            'message' => 'Basic authentication is required!'
            ]);
        } else {
            $username = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PW'];

            $list = $this->conn->query("SELECT * FROM $this->tblName");

        if ($username === 'Nelson John' && $password === 'Montezo') {
            echo json_encode([
                "code" => 200,
                "message" => 'Authentication successfully!'
            ]);
            return json_encode($list->fetch_all(MYSQLI_ASSOC)); 
                      
        } else {
            echo json_encode([
                "code" => 404,
                "message" => 'Invalid Authentication!'
                ]);
            }
        }
    }
}

?>