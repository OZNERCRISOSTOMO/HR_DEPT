<?php
$hostname = "localhost";
$username = "root";
$password = "";  
$database = "calendar";   
// create connection
$con=mysqli_connect($hostname,$username,$password,$database);    
// check connection
if ($con->connect_error){
    die("Connection Failed: " . $con->connect_error);
}

echo "connected successfully";
?>   

