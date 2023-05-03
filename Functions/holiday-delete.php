<?php


    // create database connection
    $dbServername = "sql985.main-hosting.eu";
    $dbUsername = "u839345553_sbit3g";
    $dbPassword = "sbit3gQCU";
    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');

if(isset($_POST['delete_holiday'])){
    $holiday_id = $_POST['a'];
    
    
    // delete holiday record from database
    $delete_query = "DELETE FROM holiday WHERE id=$holiday_id";
    $result = $conn->query($delete_query);
    
    // redirect to the same page after deleting record
    header("Location: ../Pages/dashboard.php?value=delete");
 
}

?>