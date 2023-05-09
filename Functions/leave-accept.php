<?php

    $dbServername = "sql985.main-hosting.eu";
    $dbUsername = "u839345553_sbit3g";
    $dbPassword = "sbit3gQCU";

    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');

     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
     
     if(isset($_POST['acceptbtn'])){
        $id = $_POST['acceptid'];
        $overtime1 = "SELECT * FROM `leave` WHERE id = $id";
        $queryko = $conn->query($overtime1);
        $date = $queryko->fetch_assoc();
        $date_end = $date['date_ended'];
        $date_start = $date['date_started'];

        $diff_absent = "SELECT DATEDIFF('$date_end', '$date_start') AS days, sick_leave, vacation_leave FROM employee_details";
        $diff_query = $conn->query($diff_absent);
        $diff_row = $diff_query->fetch_assoc();

        if($date['Type'] == "Sick Leave"){
            $update_leave_days = "UPDATE employee_details SET sick_leave = sick_leave - '".$diff_row['days']."' WHERE employee_id = '$id'";
            $conn->query($update_leave_days);
            
            $delete_absent = "DELETE FROM attendance WHERE (date BETWEEN '$date_start' AND '$date_end') AND employee_id = '$id'";
            $delete_query = $conn->query($delete_absent);

            $update_stat = "UPDATE `leave` SET status = 1 WHERE id = '$id'";
            $conn->query($update_stat);
        }else if($date['Type'] == "Vacation Leave"){
            $start = strtotime($date_start);
            $end = strtotime($date_end);
            $interval = 86400;

            $employeee = "SELECT * FROM employees WHERE id = '".$date['employee_id']."'";
            $employee_query = $conn->query($employeee);
            $employee_row = $employee_query->fetch_assoc();
            $name = "".$employee_row['first_name']." ".$employee_row['last_name']."";


            for ($timestamp = $start; $timestamp <= $end; $timestamp += $interval) {
                $formatted_date = date('Y-m-d', $timestamp);

                $sahod = 8;
                 
                $insertVac = "INSERT INTO attendance (employee_id, name, date, time_in, status, num_hr, schedule_id) VALUES ('".$date['employee_id']."', '$name', '$formatted_date', 'null', 'VACATION LEAVE', 0, '".$employee_row['schedule_id']."')";
                $conn->query($insertVac);

                $updateSalary = "UPDATE employee_details SET num_hr = num_hr + $sahod WHERE employee_id = '".$date['employee_id']."'";
                $conn->query($updateSalary);
            }

            $update_stat = "UPDATE `leave` SET status = 1 WHERE id = '$id'";
            $conn->query($update_stat);
        }
     }