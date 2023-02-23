<?php

class Database
{
    private $dbServername = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";

    public function connect()
    {
        $connect = new PDO("mysql:host=$this->dbServername;dbname=sbit3g", $this->dbUsername, $this->dbPassword);

        // set the PDO error mode to exception
        $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

        return $connect;    
    }
}