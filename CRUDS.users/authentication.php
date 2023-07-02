<?php

include "user.php"; 

header("Content-type: application/json; charset=UTF-8");
header('WWW-Authentication: Basic realm="My Private Area"');
header('HTTP/1.0 401 Unauthorized');

//initialize user class
$user = new user();

//connect to database and create table
$user->createTable();

//call get table
echo $user->authentication($_GET);

?>