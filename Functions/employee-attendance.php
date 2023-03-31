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

    if(isset($_POST['signin'])){

        $employee = $_POST['employee'];
		$status = $_POST['status'];

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

            if($status == "in"){
                $sql = "SELECT *,attendance.id AS uid FROM attendance WHERE employee_id = '$id' AND date = '$date_now' AND time_in IS NOT NULL";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					echo "You have time in for today!";
				}else{
                    $timezone = 'Asia/Manila';
	                date_default_timezone_set($timezone);
                    $sched = $row['schedule_id'];
                    $lognow = date('H:i:s');
                    $sql = "SELECT * FROM schedule WHERE id = '$sched'";
					$squery = $conn->query($sql);
					$srow = $squery->fetch_assoc();
					$logstatus = ('08:30:00' > $lognow)? 'ontime':'late';
                    if($lognow >= $srow['time_in']){
                    $sql = "INSERT INTO attendance (employee_id, date, time_in, status) VALUES ('$id', '$date_now', '$lognow', '$logstatus')";
					if($conn->query($sql)){
                        echo '<img src="../Uploads/' . $row2['picture_path'] . '" alt="avatar" style="width: 150px;" class="img-fluid m-0 rounded-circle"><br/>';
						echo "Employee ID = ".$id." <br/>";
                        echo "Employee Name = ".$row['first_name']." ".$row['last_name']."<br/>";
                        echo "Position = ".$row2['position']."<br/>";
                        echo "Time in = ".$lognow."";
                        echo "<script>
                            setTimeout(function(){
                                window.history.back();
                            }, 5000);
                        </script>";
					}
					else{
						echo "Error";
					}
                }else{
                    echo "You can't time in";
                    echo "<script>
                            setTimeout(function(){
                                window.history.back();
                            }, 3000);
                        </script>";
                }
                }

            }else{
            $sql = "SELECT *,attendance.id AS uid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.employee_id = '$id' AND date = '$date_now'";
				$query = $conn->query($sql);
				if($query->num_rows < 1){
		
					echo 'Cannot Timeout. No time in.';
                    echo "<script>
                            setTimeout(function(){
                                window.history.back();
                            }, 3000);
                        </script>";
				}else{
                    $row = $query->fetch_assoc();
                    if($row['time_out'] != '00:00:00'){
                        echo 'You have timed out for today';
                        echo "<script>
                            setTimeout(function(){
                                window.history.back();
                            }, 3000);
                        </script>";
                    }else{
					$timezone = 'Asia/Manila';
	                date_default_timezone_set($timezone);
                    $lognow = date('H:i:s');
                    $sql = "UPDATE attendance SET time_out = '17:00:00' WHERE id = '".$row['uid']."'";
                    if($conn->query($sql)){
                        echo '<img src="../Uploads/' . $row2['picture_path'] . '" alt="avatar" style="width: 150px;" class="img-fluid m-0 rounded-circle"><br/>';
						echo "Employee ID = ".$id." <br/>";
                        echo "Employee Name = ".$row['first_name']." ".$row['last_name']."<br/>";
                        echo "Position = ".$row2['position']."<br/>";
                        echo "Time in = ".$row['time_in']."<br/>";
                        echo "Time out = ".$lognow."";
                        echo "<script>
                            setTimeout(function(){
                                window.history.back();
                            }, 3000);
                        </script>";
                        

                        $sql = "SELECT * FROM attendance WHERE id = '".$row['uid']."'";
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

                        if($srow['time_out'] < $urow['time_in']){
                            $time_out = $srow['time_out'];
                        }

                        $time_in = new DateTime($time_in);
                        $time_out = new DateTime($time_out);
                        $interval = $time_in->diff($time_out);
                        $hrs = $interval->format('%h');
                        $mins = $interval->format('%i');
                        $mins2 = $mins/60;
                        $int = $hrs + $mins2;
                        
                        $sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '".$row['uid']."'";
						$conn->query($sql);

                        $sql123 = "UPDATE employee_details SET num_hr = num_hr + $int WHERE employee_id = $id";
                        $conn->query($sql123);
                    }
                    else{
                        echo $conn->error;
                    }
                }
                }
            }
        }
    else{
        echo 'Employee ID not found';
    }
}
?>