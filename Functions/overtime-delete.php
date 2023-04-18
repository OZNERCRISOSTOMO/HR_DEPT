<?php 
    $dbServername = "sql985.main-hosting.eu";
    $dbUsername = "u839345553_sbit3g";
    $dbPassword = "sbit3gQCU";

    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['deleteid'])) {
        $id = $_POST['deleteid'];
    
        if (isset($_POST['deletebtn'])) {
            $query = "DELETE FROM overTime WHERE id = '$id'";
            $conn->query($query);

            header("Location: ../Pages/admin-attendanceList.php?value=delete");
        }
    }
?>