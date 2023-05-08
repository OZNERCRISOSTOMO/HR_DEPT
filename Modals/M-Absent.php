<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
<div class="modal fade" id="absentModal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel1">Absents</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          <div class="container">
		<h2 class="text-center">Attendance Monitoring</h2>
		<table id="attendanceTable" class="table table-striped">
			<thead>
				<tr>
			<th>Employee ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Status</th>
				</tr>
			</thead>
			<tbody>
      <?php
   // establish a connection to the MySQL database
   $conn = mysqli_connect("sql985.main-hosting.eu", "u839345553_sbit3g", "sbit3gQCU", "u839345553_SBIT3G");

   // check if connection was successful
   if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }

        if($lognow < "16:30:00"){
            $employee = $admin->selectEmployeeSched('1');
        }else if($lognow > "16:30:00"){
            $employee = $admin->selectEmployeeSched('2');
        }
        $timezone = 'Asia/Manila';
        date_default_timezone_set($timezone);
        $date_now = date('Y-m-d');
                $count = 0;
                foreach ($employee as $sched) {
                    foreach ($sched as $key => $value) {
    
                    //check in attendance if exist 
                    $valueEmployee = $admin->checkAttendance($value);
    
                    if(!$valueEmployee){
                        $count++;
                        $employeeInfo = $admin->findEmployeeById($value);
                  if(!empty($employeeInfo)){
                    echo "<tr><td>".$employeeInfo[0]['id']."</td>";
                    echo "<td>".$employeeInfo[0]['first_name']."</td>";
                    echo "<td>".$employeeInfo[0]['last_name']."</td>";
                    echo '<td><span class="badge text-bg-danger">Absent</span></td></tr>';
                    }


                    
                    $checkAttendancevalue = "SELECT * FROM attendance WHERE date = '$date_now' AND status = 'ABSENT' AND employee_id = '".$employeeInfo[0]['id']."' AND schedule_id ='".$employeeInfo[0]['schedule_id']."'";
                    $query123 = $conn->query($checkAttendancevalue);
                    if($query123->num_rows > 0){
            
                    
                  }else{
                    if($lognow > '16:00:00' && $employeeInfo[0]['schedule_id'] == '1'){
                      $insertAbsent = "INSERT INTO attendance (name, employee_id, date,time_in, status, time_out , schedule_id) VALUES ('".$employeeInfo[0]['first_name']." ".$employeeInfo[0]['last_name']."','".$employeeInfo[0]['id']."', '$date_now', 'null', 'ABSENT', 'null','1')";
                      $conn->query($insertAbsent);
                    }else if($lognow >= '22:00:00' && $employeeInfo[0]['schedule_id'] == '2'){
                      $insertAbsent = "INSERT INTO attendance (name, employee_id, date,time_in, status, time_out , schedule_id) VALUES ('".$employeeInfo[0]['first_name']." ".$employeeInfo[0]['last_name']."','".$employeeInfo[0]['id']."', '$date_now', 'null','ABSENT', 'null', '2')";
                      $conn->query($insertAbsent);
                  }
                  }
                }
    
        }
    }
?>
			</tbody>
		</table>
    

	</div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         
          </div>
        </div>
      </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script  src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
 $(document).ready(function(){
    $('#attendanceTable').DataTable();
  });

 
  
  
  
  </script>