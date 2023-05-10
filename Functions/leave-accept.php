<?php
    require '../Classes/admin.php';
    require '../Classes/database.php';
    
    $database = new Database();
    $admin = new Admin($database);

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

        $diff_absent = "SELECT DATEDIFF('$date_end', '$date_start') AS days";
        $diff_query = $conn->query($diff_absent);
        $diff_row = $diff_query->fetch_assoc();

        $num = intval($diff_row['days']);
        
        $email = "SELECT * FROM employees WHERE id = '".$date['employee_id']."'";
        $email_query = $conn->query($email);
        $email_row = $email_query->fetch_assoc();
        // var_dump($email_row);
        if($date['Type'] == "Sick Leave"){
            $update_leave_days = "UPDATE employee_details SET sick_leave = sick_leave-$num WHERE employee_id = '".$date['employee_id']."'";
            $update = $conn->query($update_leave_days);
            
            $delete_absent = "DELETE FROM attendance WHERE (date BETWEEN '$date_start' AND '$date_end') AND employee_id = '".$date['employee_id']."'";
            $delete_query = $conn->query($delete_absent);

            $update_stat = "UPDATE `leave` SET status = 1 WHERE id = '$id'";
            $conn->query($update_stat);
            if($update){
                header("Location: ../Pages/Leave.php?success=accepted");

                $mess = "";
                $database->sendEmail($email_row['email'],$date['Type'],"Accepted");
            }


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
                 
                $insertVac = "INSERT INTO attendance (employee_id, name, date, time_in, status, num_hr, schedule_id) VALUES ('".$date['employee_id']."', '$name', '$formatted_date', 'null', 'VACATION LEAVE', 0, '".$employee_row['schedule_id']."')";
                $conn->query($insertVac);

            }

            $update_stat = "UPDATE `leave` SET status = 1 WHERE id = '$id'";
            $conn->query($update_stat);

            $update_leave_days = "UPDATE employee_details SET vacation_leave = vacation_leave - $num WHERE employee_id = '".$date['employee_id']."'";
            $update = $conn->query($update_leave_days);

            if($update){
                header("Location: ../Pages/Leave.php?success=accepted");
                $database->sendEmail($email_row['email'],$date['Type'],"Accepted");
            }
        }else{
            
            $delete_absent = "DELETE FROM attendance WHERE (date BETWEEN '$date_start' AND '$date_end') AND employee_id = '".$date['employee_id']."'";
            $delete_query = $conn->query($delete_absent);

            $update_stat = "UPDATE `leave` SET status = 1 WHERE id = '$id'";
            $update = $conn->query($update_stat);

            if($update){
                header("Location: ../Pages/Leave.php?success=accepted");
                $database->sendEmail($email_row['email'],$date['Type'],"Accepted");
            }
        }
     }