<?php

class DBModel
{
    protected $conn;

    public function db(){
        $this->conn = new mysqli('localhost', 'user', '123test', 'aplicatie_facturare');
     // $this->conn = new mysqli('92.114.98.5', 'user', '33Decalamari', 'aplicatie_facturare');
        if($this->conn->connect_error){
            die('Connection error!');
        }
        return $this->conn;
    } 
}