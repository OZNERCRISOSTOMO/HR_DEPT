<?php

class Database
{
    private $dbServername = "sql985.main-hosting.eu";
    private $dbUsername = "u839345553_sbit3g";
    private $dbPassword = "sbit3gQCU";

    public function connect()
    {
        $connect = new PDO("mysql:host=$this->dbServername;dbname=u839345553_SBIT3G", $this->dbUsername, $this->dbPassword);

        // set the PDO error mode to exception
        $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

        return $connect;    
    }
}