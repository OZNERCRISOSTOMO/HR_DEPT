<?php 
    $dbServername = "sql985.main-hosting.eu";
    $dbUsername = "u839345553_sbit3g";
    $dbPassword = "sbit3gQCU";

    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['acceptid'])) {
        $id = $_POST['acceptid'];
        $overtime1 = "SELECT * FROM overTime WHERE id = $id";
        $queryko = $conn->query($overtime1);
        $date = $queryko->fetch_assoc();
    
        if (isset($_POST['acceptbtn'])) {
          $acceptOT = "UPDATE attendance SET over_time = '".$date['over_time']."' WHERE employee_id = '".$date['employee_id']."' AND date = '".$date['date']."'";
          $conn->query($acceptOT);
    
          $acceptOTT = "UPDATE employee_details SET over_time = over_time + '".$date['over_time']."' WHERE employee_id = '".$date['employee_id']."'";
          $conn->query($acceptOTT);
    
          $delete = "DELETE FROM overTime WHERE id = '$id'";
          $conn->query($delete);

          header("Location: ../Pages/admin-attendanceList.php?value=accept");
        }
    }
?>