<?php 
$dbServername = "sql985.main-hosting.eu";
$dbUsername = "u839345553_sbit3g";
$dbPassword = "sbit3gQCU";

$conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');
$date = new DateTime();
$timezone = 'Asia/Manila';
date_default_timezone_set($timezone);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['signin'])){
    // getting data from the FORM
    $username = $_POST['email'];
    $password = $_POST['password'];

    // Query the database
    $sql1 = "SELECT * FROM employee_login WHERE login_id='$username'";
    $query1 = $conn->query($sql1);

    // Check if the username and password are valid
    if ($query1->num_rows > 0) {
        $row1 = $query1->fetch_assoc();
        $_SESSION['login_id'] = $row1['login_id'];

        //getting the password and compare to hash
        $input_password = $row1['login_password']; //getting the password from database and save as variable
        $hashed_input_password = password_hash($password, PASSWORD_DEFAULT); //compare and convert password

        // Check if the hashed password matches the stored password
        if (password_verify($password, $input_password)) {
        	// Get the Info of employee
            
            $sql2 = "SELECT * FROM employee_details WHERE employee_id = '".$row1['employee_id']."'";
		    $query2 = $conn->query($sql2);
            $row2 = $query2->fetch_assoc();

            $sql = "SELECT * FROM employees WHERE id = '".$row1['employee_id']."'";
		    $query = $conn->query($sql);
            $row = $query->fetch_assoc();
			$id = $row['id'];
            $timezone = 'Asia/Manila';
	        date_default_timezone_set($timezone);
            $date_now = date('Y-m-d');
            $name = "".$row['first_name']." ".$row['last_name']."";


            // Check if the employee has record in Time_in in the current date
            $sql3 = "SELECT *,attendance.id AS uid FROM attendance WHERE employee_id = '$id' AND date = '$date_now' AND time_in IS NOT NULL";
			$query3 = $conn->query($sql3);

            // If the employee has time in and the RFID tap it will record time_out if not it will record Time_in
            if($query3->num_rows > 0){

                // Get the info in the attendance and employees table
                $sql = "SELECT *,attendance.id AS uid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id' AND date = '$date_now'";
				$query = $conn->query($sql);
                $timeout = $query->fetch_assoc();

                $timezone = 'Asia/Manila';
	            date_default_timezone_set($timezone);
                $lognow = date('H:i:s');

                $checkifAbsent = "SELECT * FROM attendance WHERE date = '$date_now' AND employee_id = '$id' AND (status = 'ONTIME' OR status = 'LATE' OR status = 'VACATION LEAVE' OR status = 'MATERNITY LEAVE' OR status = 'PATERNITY LEAVE')";
                $queryCheckAbsent = $conn->query($checkifAbsent);
                $ifAbsent_row = $queryCheckAbsent->fetch_assoc();
                if($ifAbsent_row['status'] == 'ONTIME' || $ifAbsent_row['status'] == 'LATE'){

                
                // Update the attendace table set time_out to current time.
                $sql = "UPDATE attendance SET time_out = '$lognow' WHERE id = '".$timeout['uid']."'";
                    if($conn->query($sql)){
                        header("Location: ../Pages/employee-attendance.php?value=Timeout&picture=".$row2['picture_path']."&ID=".$id."&name=".$row['first_name']." ".$row['last_name']."&post=".$row2['position']."&Timeout=".$lognow."&dep=".$row2['department']."");

                        // Get the value of table attendance.
                        $attendance = "SELECT * FROM attendance WHERE id = '".$timeout['uid']."'";
                        $query = $conn->query($attendance);
                        $urow = $query->fetch_assoc();

                        // Get the time_in and time_out column in the table attendance.
                        $time_in = $urow['time_in'];
                        $time_out = $urow['time_out'];

                        // Get the schedule of the employee.
                        $sqle = "SELECT * FROM employees LEFT JOIN schedule ON schedule.id=employees.schedule_id WHERE employees.id = $id";
                        $query = $conn->query($sqle);
                        $srow = $query->fetch_assoc();

                        // If the schedule time_in is greater than the time_in in the attendace table.
                        if($srow['time_in'] > $urow['time_in']){

                            // Set the value of time_in base on her schedule
                            $time_in = $srow['time_in'];
                        }
                        // If the schedule time_out is less than the time_out in attendance table.
                        if($srow['time_out'] < $urow['time_out'] && $srow['schedule_id'] === '1'){

                            // If the attendance time_out is greater than 4:30 in First Schedule.
                            if($srow['schedule_id'] === '1' && $urow['time_out'] > '15:30:00'){

                                // Calculate Overtime
                                $overtime1 = '15:30:00';
                                $time_out = new DateTime($urow['time_out']);
                                $overT = new DateTime($overtime1);
                                $interval = $time_out->diff($overT);
                                $hrs = $interval->format('%h');
                                $mins = $interval->format('%i');
                                $mins2 = $mins/60;
                                $int = $hrs + $mins2;

                            }

                            // Record Overtime in table overTime. 
                        
                            $overT = "INSERT INTO overTime (name, employee_id, remarks, date, over_time) VALUES ('$name', '$id','Over Time', '$date_now','$int')";
                            $conn->query($overT);
                            
                            $time_out = $srow['time_out'];
                            
                        }

                        // Calculate the number of hours.
                        $time_inn = new DateTime($time_in);
                        $time_outt = new DateTime($time_out);
                        $interval = $time_inn->diff($time_outt);
                        $hrs = $interval->format('%h');
                        $mins = $interval->format('%i');
                        $mins2 = $mins/60;
                        $sql_double = "SELECT * FROM holiday WHERE holiday_date = '$date_now'";
                        $query_double = $conn->query($sql_double);
                        $row2_double = $query_double->fetch_assoc();
                        if($query_double->num_rows > 0 ){
                            $percent = $row2_double['percentage'];
                            $doublepay = $hrs + $mins2;
                            $int = $doublepay*$percent;
                        }else{
                            $int = $hrs + $mins2;
                        }

                    
                        // If the time_out schedule is Less than the time_out in the attendance.
                    if($srow['time_out'] < $urow['time_out']){
                        // If the attendance did not record the number of hour.
                        if($urow['num_hr'] == 0){
                        // Add the total number of hour
                        $sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '".$timeout['uid']."'";
						$conn->query($sql);

                        $sql123 = "UPDATE employee_details SET num_hr = num_hr + $int WHERE employee_id = $id";
                        $conn->query($sql123);
                        }
                        // If the time_out schedule is Greater than the time_out in the attendance.
                    }else if($srow['time_out'] > $urow['time_out']){

                        // Record Undertime in Table overTime
                        
                        $undertime = "INSERT INTO overTime (Name, employee_id, remarks, date, over_time) VALUES ('$name', '$id', 'Under Time', '$date_now','$int')";
                        $conn->query($undertime);
                    }  
                }
                    else{
                        echo $conn->error;
                    }
                }elseif($ifAbsent_row['status'] == 'VACATION LEAVE'){
                    header("Location: ../Pages/employee-attendance.php?value=vleave");
                }elseif($ifAbsent_row['status'] == 'MATERNITY LEAVE'){
                    header("Location: ../Pages/employee-attendance.php?value=mleave");
                }elseif($ifAbsent_row['status'] == 'PATERNITY LEAVE'){
                    header("Location: ../Pages/employee-attendance.php?value=pleave");
                }else{
                    header("Location: ../Pages/employee-attendance.php?value=invalidSched");
                }

            }else{

                // Record time_in of the employee
                $timezone = 'Asia/Manila';
	                date_default_timezone_set($timezone);
                    $sched = $row['schedule_id'];
                    $lognow = date('H:i:s');
                    $sql = "SELECT * FROM schedule WHERE id = '$sched'";
					$squery = $conn->query($sql);
					$srow = $squery->fetch_assoc();

                    if($srow['time_in'] == '07:00:00'){
                        $logstatus = ('07:30:00' > $lognow)? 'ONTIME':'LATE';
                    }else if($srow['time_in'] == '15:00:00'){
                        $logstatus = ('15:30:00' > $lognow)? 'ONTIME':'LATE';
                    }

                
                    $name = "".$row['first_name']." ".$row['last_name']."";
                    $employeeQuery = "SELECT COUNT(status) as count FROM attendance WHERE employee_id = '$id' AND status = 'ABSENT'";
                    $employeeResult = $conn->query($employeeQuery);
                    $countRow = $employeeResult->fetch_assoc();

                    $yesterday = date('Y-m-d', strtotime('-1 day'));
                    $absent_yesterday = "SELECT * FROM attendance WHERE employee_id = '$id' AND status = 'ABSENT' AND date = '$yesterday'";
                    $absent_query = $conn->query($absent_yesterday);

                            // If the Employee Tap card and not Following on their schedule.
                            if(($sched == '1' && $srow['time_out'] > $lognow) || ($sched == '2' && $srow['time_in'] < $lognow)){
                                
                                if($countRow['count'] >= 7){
                                    header("Location: ../Pages/employee-attendance.php?value=suspend");
                                }elseif($absent_query->num_rows > 0){
                                    header("Location: ../Pages/employee-attendance.php?value=absentYesterday");
                                }else{
                                $sql = "INSERT INTO attendance (employee_id, name, date, time_in, status, schedule_id) VALUES ('$id', '$name', '$date_now', '$lognow', '$logstatus', '$sched')";
					            if($conn->query($sql)){
                        
                                header("Location: ../Pages/employee-attendance.php?value=Timein&picture=".$row2['picture_path']."&ID=".$id."&name=".$row['first_name']." ".$row['last_name']."&post=".$row2['position']."&Timein=".$lognow."&status=".$logstatus."&dep=".$row2['department']."");
					            }else{
						        echo "Error";
					            }
                            }
                            }else{
                                header("Location: ../Pages/employee-attendance.php?value=invalidSched");
                            }
                
            }

        }else{
            // Employee Not found
            header("Location: ../Pages/employee-attendance.php?value=invalidPass");
        }
    } else {
        header("Location: ../Pages/employee-attendance.php?value=invalidUser");
    }
}