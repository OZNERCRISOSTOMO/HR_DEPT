
<?php
     $timezone = 'Asia/Manila';
     date_default_timezone_set($timezone);
 
     $dbServername = "sql985.main-hosting.eu";
     $dbUsername = "u839345553_sbit3g";
     $dbPassword = "sbit3gQCU";
 
     $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');
     $date = new DateTime();
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }

     if(isset($_POST['employee'])){

        $employee = $_POST['employee'];

        $sql1 = "SELECT * FROM RFID_card WHERE serial_number = '$employee'";
        $query1 = $conn->query($sql1);
        $row1 = $query1->fetch_assoc();

        if($query1->num_rows > 0){
            $sql2 = "SELECT * FROM employee_details WHERE employee_id = '".$row1['employee_id']."'";
		    $query2 = $conn->query($sql2);
            $row2 = $query2->fetch_assoc();

            $sql = "SELECT * FROM employees WHERE id = '".$row1['employee_id']."'";
		    $query = $conn->query($sql);
            $row = $query->fetch_assoc();
			$id = $row['id'];
            $date_now = date('Y-m-d');

            $sql3 = "SELECT *,attendance.id AS uid FROM attendance WHERE employee_id = '$id' AND date = '$date_now' AND time_in IS NOT NULL";
			$query3 = $conn->query($sql3);
            if($query3->num_rows > 0){
                $sql = "SELECT *,attendance.id AS uid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id' AND date = '$date_now'";
				$query = $conn->query($sql);
                $timeout = $query->fetch_assoc();

                $timezone = 'Asia/Manila';
	            date_default_timezone_set($timezone);
                $lognow = date('H:i:s');
                $sql = "UPDATE attendance SET time_out = '$lognow' WHERE id = '".$timeout['uid']."'";
                    if($conn->query($sql)){
                        header("Location: ../Pages/employee-attendance.php?value=Timeout&picture=".$row2['picture_path']."&ID=".$id."&name=".$row['first_name']." ".$row['last_name']."&post=".$row2['position']."&Timeout=".$lognow."&dep=".$row2['department']."");

                        $sql = "SELECT * FROM attendance WHERE id = '".$timeout['uid']."'";
                        $query = $conn->query($sql);
                        $urow = $query->fetch_assoc();

                        $time_in = $urow['time_in'];
                        $time_out = $urow['time_out'];

                        $sql = "SELECT * FROM employees LEFT JOIN schedule ON schedule.id=employees.schedule_id WHERE employees.id = $id";
                        $query = $conn->query($sql);
                        $srow = $query->fetch_assoc();

                        if($srow['time_in'] > $urow['time_in']){
                            $time_in = $srow['time_in'];
                        }

                        if($srow['time_out'] < $urow['time_out']){
                            if($srow['id'] === '1' && $urow['time_out'] > '16:30:00'){
                                $overtime1 = '16:30:00';
                                $time_out = new DateTime($urow['time_out']);
                                $overT = new DateTime($overtime1);
                                $interval = $time_out->diff($overT);
                                $hrs = $interval->format('%h');
                                $mins = $interval->format('%i');
                                $mins2 = $mins/60;
                                $int = $hrs + $mins2;


                            }else if($srow['id'] === '2' && $urow['time_out'] > '22:30:00'){
                                $overtime1 = '22:30:00';
                                $time_out = new DateTime($urow['time_out']);
                                $overT = new DateTime($overtime1);
                                $interval = $time_out->diff($overT);
                                $hrs = $interval->format('%h');
                                $mins = $interval->format('%i');
                                $mins2 = $mins/60;
                                $int = $hrs + $mins2;

                            }
                            $overT = "INSERT INTO overTime (employee_id, remarks, date, over_time) VALUES ('$id','Over Time', '$date_now','$int')";
                            $conn->query($overT);
                            $time_out = $srow['time_out'];
                        }

                        $time_in = new DateTime($time_in);
                        $time_out = new DateTime($time_out);
                        $interval = $time_in->diff($time_out);
                        $hrs = $interval->format('%h');
                        $mins = $interval->format('%i');
                        $mins2 = $mins/60;
                        $int = $hrs + $mins2;
                        
                        $sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '".$timeout['uid']."'";
						$conn->query($sql);

                        $sql123 = "UPDATE employee_details SET num_hr = num_hr + $int WHERE employee_id = $id";
                        $conn->query($sql123);
                    }
                    else{
                        echo $conn->error;
                    }

            }else{
                $timezone = 'Asia/Manila';
	                date_default_timezone_set($timezone);
                    $sched = $row['schedule_id'];
                    $lognow = date('H:i:s');
                    $sql = "SELECT * FROM schedule WHERE id = '$sched'";
					$squery = $conn->query($sql);
					$srow = $squery->fetch_assoc();
                    $logstatus = ($srow['time_in'] > $lognow)? 'ONTIME':'LATE';
                    
                    $sql = "INSERT INTO attendance (employee_id, date, time_in, status) VALUES ('$id', '$date_now', '$lognow', '$logstatus')";
					if($conn->query($sql)){
                        
                        header("Location: ../Pages/employee-attendance.php?value=Timein&picture=".$row2['picture_path']."&ID=".$id."&name=".$row['first_name']." ".$row['last_name']."&post=".$row2['position']."&Timein=".$lognow."&status=".$logstatus."&dep=".$row2['department']."");
					}
					else{
						echo "Error";
					}
            }

        }else{
            header("Location: ../Pages/employee-attendance.php?value=employeeNotfound");
        }
     }else{

     }
?>