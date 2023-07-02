<?php

include 'Product.php';

header('Content-type: application/json; charset=UTF-8');

// initialize product class
$product = new Product();

// connect to database and create table
$product->createTable();

// call create method
echo $product->create($_POST);

?>