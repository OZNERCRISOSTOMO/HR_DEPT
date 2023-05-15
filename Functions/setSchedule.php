<?php
// establish a connection to the MySQL database
$conn = mysqli_connect("sql985.main-hosting.eu", "u839345553_sbit3g", "sbit3gQCU", "u839345553_SBIT3G");

// check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit1'])){
    $id = $_POST['id'];
    $value = $_POST['schedule'];
    $sql = "UPDATE employees SET schedule_id = $value WHERE id = $id";
    $query = $conn->query($sql);
    if($query){
        header("Location: ../Pages/ListEmployee_Dept.php");
    }else{
        echo "makyu";
    }
}

