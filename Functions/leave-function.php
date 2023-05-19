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
                
                $diff_absent = "SELECT sick_leave, vacation_leave, paternity_leave, maternity_leave FROM employee_details WHERE employee_id = $employee_id";
                $diff_query = $conn->query($diff_absent);
                $diff_row = $diff_query->fetch_assoc();

                $diff_days = "SELECT DATEDIFF('$date_end', '$date_start') AS days";
                $diff_query1 = $conn->query($diff_days);
                $diff_row1 = $diff_query1->fetch_assoc();

                if($leave_type == "Sick Leave"){
                    if($diff_row['sick_leave'] >= $diff_row1['days']){
                    // $emp = "SELECT id FROM employees WHERE gender = 'male'";
                    // $empr = $conn->query($emp);
                    // while($row1 = mysqli_fetch_assoc($empr)){
                    //     $id = $empr['id'];
                    // $select = "UPDATE employee_details SET maternity_leave = 0 WHERE employee_id = $id";
                    // $select1 = $conn->query($select);
                    // }
                    $insert_leave = "INSERT INTO leave_p (name, type, date_started, date_ended, employee_id, Department, description) VALUES ('$name', '$leave_type', '$date_start', '$date_end', '$employee_id', '$dept', '$des')";
                    $insert_query = $conn->query($insert_leave);

                    header('Location: ../Pages/ListEmployee_Dept.php?value=insert');
                }else{
                    header('Location: ../Pages/ListEmployee_Dept.php?value=invalid');
                }
            }else if($leave_type == "Vacation Leave"){
                if($diff_row['vacation_leave'] >= $diff_row1['days']){
                    $insert_leave = "INSERT INTO leave_p (name, type, date_started, date_ended, employee_id, Department, description) VALUES ('$name', '$leave_type', '$date_start', '$date_end', '$employee_id', '$dept', '$des')";
                    $insert_query = $conn->query($insert_leave);

                    header('Location: ../Pages/ListEmployee_Dept.php?value=insert');
                }else{
                    header('Location: ../Pages/ListEmployee_Dept.php?value=invalid');
                }
            }else if($leave_type == "Maternity Leave"){
                if($diff_row['maternity_leave'] >= $diff_row1['days']){
                    $insert_leave = "INSERT INTO leave_p (name, type, date_started, date_ended, employee_id, Department, description) VALUES ('$name', '$leave_type', '$date_start', '$date_end', '$employee_id', '$dept', '$des')";
                    $insert_query = $conn->query($insert_leave);

                    header('Location: ../Pages/ListEmployee_Dept.php?value=insert');
                }else{
                    header('Location: ../Pages/ListEmployee_Dept.php?value=invalid');
                }
            }else if($leave_type == "Paternity Leave"){
                if($diff_row['paternity_leave'] >= $diff_row1['days']){
                    $insert_leave = "INSERT INTO leave_p (name, type, date_started, date_ended, employee_id, Department, description) VALUES ('$name', '$leave_type', '$date_start', '$date_end', '$employee_id', '$dept', '$des')";
                    $insert_query = $conn->query($insert_leave);

                    header('Location: ../Pages/ListEmployee_Dept.php?value=insert');
                }else{
                    header('Location: ../Pages/ListEmployee_Dept.php?value=invalid');
                }
            }else{
                $insert_leave = "INSERT INTO leave_p (name, type, date_started, date_ended, employee_id, Department, description) VALUES ('$name', '$leave_type', '$date_start', '$date_end', '$employee_id', '$dept', '$des')";
                $insert_query = $conn->query($insert_leave);
                header('Location: ../Pages/ListEmployee_Dept.php?value=insert');
        }
     }else{
        header('Location: ../Pages/ListEmployee_Dept.php?value=invalidUser');
     }
    }