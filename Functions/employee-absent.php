<?php
            $timezone = 'Asia/Manila';
            date_default_timezone_set($timezone);
            $lognow = date('H:i:s');

            $dbServername = "sql985.main-hosting.eu";
            $dbUsername = "u839345553_sbit3g";
            $dbPassword = "sbit3gQCU";
 
            $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
          $data = array();
          $date_now = date('Y-m-d');
            $lognow = date('H:i:s');
              if($lognow < "16:30:00"){
                  $employee = "SELECT id FROM employees WHERE schedule_id = '1' ";
                  $total = $conn->query($employee);
              }else if($lognow > "16:30:00"){
                $employee = "SELECT id FROM employees WHERE schedule_id = '2' ";
                $total = $conn->query($employee);
              }
            $row1 = $total->fetch_all();
              
              foreach($row1 as $sched) {
                foreach ($sched as $key => $value) {
                    $checkValueinAttendance = "SELECT * FROM attendance WHERE employee_id = '$value' AND date = '$date_now' AND (status = 'ONTIME' OR status = 'LATE')";
                    $check = $conn->query($checkValueinAttendance);
                    $row2 = $check->fetch_all();
                    
                    if(!$row2){
                        $print = "SELECT * FROM employees WHERE id ='$value'";
                        $employees = $conn->query($print);
                        $row3 = $employees->fetch_assoc(); 
                        
                        $data [] = $row3;  
                    }else{
                       
                    }
                    
                    if($lognow > '16:00:00' && $row3['schedule_id'] == '1'){
                        $insertAbsent = "INSERT INTO attendance (name, employee_id, date, status, schedule_id) VALUES ('".$row3['first_name']." ".$row3['last_name']."','".$row3['id']."', '$date_now', 'ABSENT', '1')";
                        $conn->query($insertAbsent);
                    }else if($lognow >= '22:00:00' && $row3['schedule_id'] == '2'){
                        $insertAbsent = "INSERT INTO attendance (name, employee_id, date, status, schedule_id) VALUES ('".$row3['first_name']." ".$row3['last_name']."','".$row3['id']."', '$date_now','ABSENT', '2')";
                        $conn->query($insertAbsent);
                    }



                }

              }
              
              echo json_encode($data);

              $conn->close();
              ?>

