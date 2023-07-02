<?php

include 'Product.php';

header('Content-type: application/json; charset=UTF-8');

// initialize product class
$product = new Product();

// connect to database and create table
$product->createTable();

// call delete method
echo $product->delete($_GET);

?>