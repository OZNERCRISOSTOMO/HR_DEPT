<?php

    $dbServername = "sql985.main-hosting.eu";
    $dbUsername = "u839345553_sbit3g";
    $dbPassword = "sbit3gQCU";

    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');

     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }

     $sched = $_POST['schedule'];
     $id = $_POST['a'];

     if(isset($_POST['submittt'])){
        $update = "UPDATE employees SET schedule_id = $sched WHERE id = $id";
        $conn->query($update);
     }
     echo $id;