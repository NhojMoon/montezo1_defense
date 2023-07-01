<?php

abstract class Database
{
    abstract function initialize();
    abstract function getError();
}

interface Functions
{
    public function createTable();
    public function getAll();
    public function create($params);
    public function update($params);
    public function delete($params);
    public function search($params);
}

?>