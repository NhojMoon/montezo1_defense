<?php

include 'table.php';

$okay = new Product();
$okay->createTable();

$values = 
[
    'brand' => $_GET['brand'],
    'price' => $_GET['price'],
    'description' => $_GET['description']
];

$status = $okay->insert($values);

if ($status == true)
{
    header('location: form.php');
}
