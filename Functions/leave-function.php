<?php

    $dbServername = "sql985.main-hosting.eu";
    $dbUsername = "u839345553_sbit3g";
    $dbPassword = "sbit3gQCU";

    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');

     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }

     $id = $_POST['loginID'];
     $name = $_POST['name'];
     $date_start = $_POST['date_started'];
     $date_end = $_POST['date_ended'];
     $leave_type = $_POST['leave'];
     $dept = $_POST['department'];

     if(isset($_POST['submitt'])){
            $diff_absent = "SELECT DATEDIFF('$date_end', '$date_start') AS days, sick_leave FROM employee_details";
            $diff_query = $conn->query($diff_absent);
            $diff_row = $diff_query->fetch_assoc();

        if($leave_type == "Sick Leave"){
            if($diff_row['sick_leave'] >= $diff_row['days']){
                // $update_leave_days = "UPDATE employee_details SET sick_leave = sick_leave - '".$diff_row['days']."' WHERE employee_id = '$id'";
                // $conn->query($update_leave_days);
            
                // $delete_absent = "DELETE FROM attendance WHERE (date BETWEEN '$date_start' AND '$date_end') AND employee_id = '$id'";
                // $delete_query = $conn->query($delete_absent); 

                $insert_leave = "INSERT INTO `leave` (name, type, date_started, date_ended, Department, description) VALUES ('$name', '$leave_type', '$date_start', '$date_end', '$dept')";
                $insert_query = $conn->query($insert_leave);

                header('Location: ../Pages/ListEmployee_Dept.php?value=insert');
            }else{
                header('Location: ../Pages/ListEmployee_Dept.php?value=invalid');
            }
        }else if($leave_type == "Vacation Leave"){
            
        }else{

        }
     }