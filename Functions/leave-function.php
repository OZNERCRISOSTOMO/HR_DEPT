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
     $des = $_POST['description'];

     
     if(isset($_POST['submitt'])){
            $employee = "SELECT * FROM employee_login WHERE login_id = '$id'";
            $employee_query = $conn->query($employee);
            

            if($employee_query->num_rows > 0 ){
                $employee_row = $employee_query->fetch_assoc();
                $employee_id = $employee_row['employee_id'];
                $diff_absent = "SELECT DATEDIFF('$date_end', '$date_start') AS days, sick_leave, vacation_leave FROM employee_details";
                $diff_query = $conn->query($diff_absent);
                $diff_row = $diff_query->fetch_assoc();

                if($leave_type == "Sick Leave"){
                    if($diff_row['sick_leave'] >= $diff_row['days']){ 
                    $insert_leave = "INSERT INTO `leave` (name, type, date_started, date_ended, employee_id, Department, description) VALUES ('$name', '$leave_type', '$date_start', '$date_end', '$employee_id', '$dept', '$des')";
                    $insert_query = $conn->query($insert_leave);

                    header('Location: ../Pages/ListEmployee_Dept.php?value=insert');
                }else{
                    header('Location: ../Pages/ListEmployee_Dept.php?value=invalid');
                }
            }else if($leave_type == "Vacation Leave"){
                if($diff_row['vacation_leave'] >= $diff_row['days']){
                    $insert_leave = "INSERT INTO `leave` (name, type, date_started, date_ended, employee_id, Department, description) VALUES ('$name', '$leave_type', '$date_start', '$date_end', '$employee_id', '$dept', '$des')";
                    $insert_query = $conn->query($insert_leave);

                    header('Location: ../Pages/ListEmployee_Dept.php?value=insert');
                }else{
                    header('Location: ../Pages/ListEmployee_Dept.php?value=invalid');
                }
            }else{

        }
     }else{
        header('Location: ../Pages/ListEmployee_Dept.php?value=invalidUser');
     }
    }