<?php

include '../product.php';

$try = new Product();
$try->createTable();

var_dump($try);