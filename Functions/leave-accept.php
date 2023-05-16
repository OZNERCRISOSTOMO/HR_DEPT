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
        $overtime1 = "SELECT * FROM leave_p WHERE id = $id";
        $queryko = $conn->query($overtime1);
        $date = $queryko->fetch_assoc();
        $date_end = $date['date_ended'];
        $date_start = $date['date_started'];

        $diff_absent = "SELECT DATEDIFF('$date_end', '$date_start') AS days";
        $diff_query = $conn->query($diff_absent);
        $diff_row = $diff_query->fetch_assoc();

        $num = intval($diff_row['days']);
        
        $email = "SELECT employees.*,employee_details.position FROM employees JOIN employee_details ON employees.id = employee_details.employee_id WHERE employees.id = '".$date['employee_id']."'";
        $email_query = $conn->query($email);
        $email_row = $email_query->fetch_assoc();
        
        $message = "Dear ".$email_row['first_name']." ".$email_row['last_name'].",\n\nWe are writing to inform you that your request for a ".$date['Type']." from ".$date_start." to ".$date_end." has been approved. We appreciate your effort in giving us enough notice and arranging the necessary coverage while you are away.\n\nWe hope that this vacation will give you the rest and relaxation that you need to come back to work refreshed and ready to take on new challenges. If you have any questions or concerns before your vacation, please feel free to get in touch with your supervisor or HR representative.\n\nEnjoy your time off, and we look forward to your return!\n\nBest regards,\nHuman Resource Department\nShine\nShine Tacsiat";

        if($date['Type'] == "Sick Leave"){
            $update_leave_days = "UPDATE employee_details SET sick_leave = sick_leave-$num WHERE employee_id = '".$date['employee_id']."'";
            $update = $conn->query($update_leave_days);
            
            $delete_absent = "DELETE FROM attendance WHERE (date BETWEEN '$date_start' AND '$date_end') AND status = 'ABSENT' AND employee_id = '".$date['employee_id']."'";
            $delete_query = $conn->query($delete_absent);

            $update_stat = "UPDATE leave_p SET status = 1 WHERE id = '$id'";
            $conn->query($update_stat);
            if($update){
                header("Location: ../Pages/Leave.php?success=accepted");
                $database->sendEmail($email_row['email'],$date['Type']." Approval",$message);
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
                 
                $insertVac = "INSERT INTO attendance (employee_id, name, date, time_in, status, num_hr, schedule_id) VALUES ('".$date['employee_id']."', '$name', '$formatted_date', 'null', 'VACATION LEAVE', 8, '".$employee_row['schedule_id']."')";
                $conn->query($insertVac);

            }

            $update_stat = "UPDATE leave_p SET status = 1 WHERE id = '$id'";
            $conn->query($update_stat);

            $update_leave_days = "UPDATE employee_details SET vacation_leave = vacation_leave - $num WHERE employee_id = '".$date['employee_id']."'";
            $update = $conn->query($update_leave_days);

            if($update){
                header("Location: ../Pages/Leave.php?success=accepted");
                $database->sendEmail($email_row['email'],$date['Type']." Approval",$message);
            }
        }else if($date['Type'] == "Paternity Leave"){
            $start = strtotime($date_start);
            $end = strtotime($date_end);
            $interval = 86400;

            $employeee = "SELECT * FROM employees WHERE id = '".$date['employee_id']."'";
            $employee_query = $conn->query($employeee);
            $employee_row = $employee_query->fetch_assoc();
            $name = "".$employee_row['first_name']." ".$employee_row['last_name']."";


            for ($timestamp = $start; $timestamp <= $end; $timestamp += $interval) {
                $formatted_date = date('Y-m-d', $timestamp);
                 
                $insertVac = "INSERT INTO attendance (employee_id, name, date, time_in, status, num_hr, schedule_id) VALUES ('".$date['employee_id']."', '$name', '$formatted_date', 'null', 'PATERNITY LEAVE', 8, '".$employee_row['schedule_id']."')";
                $conn->query($insertVac);

            }

            $update_stat = "UPDATE leave_p SET status = 1 WHERE id = '$id'";
            $conn->query($update_stat);

            $update_leave_days = "UPDATE employee_details SET paternity_leave = paternity_leave - $num WHERE employee_id = '".$date['employee_id']."'";
            $update = $conn->query($update_leave_days);

            if($update){
                header("Location: ../Pages/Leave.php?success=accepted");
                $database->sendEmail($email_row['email'],$date['Type']." Approval",$message);
            }
        }else if($date['Type'] == "Maternity Leave"){
            $start = strtotime($date_start);
            $end = strtotime($date_end);
            $interval = 86400;

            $employeee = "SELECT * FROM employees WHERE id = '".$date['employee_id']."'";
            $employee_query = $conn->query($employeee);
            $employee_row = $employee_query->fetch_assoc();
            $name = "".$employee_row['first_name']." ".$employee_row['last_name']."";


            for ($timestamp = $start; $timestamp <= $end; $timestamp += $interval) {
                $formatted_date = date('Y-m-d', $timestamp);
                 
                $insertVac = "INSERT INTO attendance (employee_id, name, date, time_in, status, num_hr, schedule_id) VALUES ('".$date['employee_id']."', '$name', '$formatted_date', 'null', 'MATERNITY LEAVE', 8, '".$employee_row['schedule_id']."')";
                $conn->query($insertVac);

            }

            $update_stat = "UPDATE leave_p SET status = 1 WHERE id = '$id'";
            $conn->query($update_stat);

            $update_leave_days = "UPDATE employee_details SET maternity_leave = maternity_leave - $num WHERE employee_id = '".$date['employee_id']."'";
            $update = $conn->query($update_leave_days);

            if($update){
                header("Location: ../Pages/Leave.php?success=accepted");
                $database->sendEmail($email_row['email'],$date['Type']." Approval",$message);
            }
        }else{
            
            $delete_absent = "DELETE FROM attendance WHERE (date BETWEEN '$date_start' AND '$date_end') AND employee_id = '".$date['employee_id']."'";
            $delete_query = $conn->query($delete_absent);

            $update_stat = "UPDATE leave_p SET status = 1 WHERE id = '$id'";
            $update = $conn->query($update_stat);

            if($update){
                header("Location: ../Pages/Leave.php?success=accepted");
                $database->sendEmail($email_row['email'],$date['Type']." Approval",$message);
            }
        }
     }