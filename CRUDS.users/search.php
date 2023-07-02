<?php

include "user.php"; 

header("Content-type: application/json; charset=UTF-8");

//initialize user class
$user = new user();

//connect to database and create table
$user->createTable();

//call get table
echo $user->search($_GET);

?>