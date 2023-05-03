<?php
    $dbServername = "sql985.main-hosting.eu";
    $dbUsername = "u839345553_sbit3g";
    $dbPassword = "sbit3gQCU";

    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');

     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }

$holiday = $_POST['hname'];
$hdate = $_POST['hdate'];
$hpercent = $_POST['hpercent'];

if(isset($_POST['hsubmit'])){
    $h_data = "SELECT * FROM holiday WHERE holiday_date = '$hdate'";
    $h_query = $conn->query($h_data);

    if($h_query->num_rows > 0){
        echo 'ADik';
    }else{
        $h_insert = "INSERT INTO holiday (holiday_name, holiday_date, percentage) VALUES ('$holiday', '$hdate', '$hpercent')";
        $h_insert_query = $conn->query($h_insert);

        if($h_insert_query){
            echo 'success';
        }
    }
}