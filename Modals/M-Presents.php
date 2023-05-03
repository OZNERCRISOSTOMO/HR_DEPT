
    <div class="modal fade" id="presentModal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel1">Presents</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          <div class="container">
		<h2 class="text-center py-2">Attendance Monitoring</h2>
		<table class="table table-striped">
			<thead>
				<tr>
					
			<th>Employee ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
			<th>Date</th>
            <th>Time In</th>
            <th>Time Out</th>
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

    $timezone = 'Asia/Manila';
	  date_default_timezone_set($timezone);
    $lognow = date('H:i:s');
    $date_now = date('Y-m-d');


    if($lognow < "16:30:00"){
      $employee = '1';
  }else if($lognow > "16:30:00"){
      $employee = '2';
  }



    // execute a SELECT statement to retrieve data from the table
    $sql = "SELECT employees.first_name, employees.last_name, attendance.*
    FROM employees
    JOIN employee_details ON employees.id = employee_details.employee_id
    JOIN attendance ON employees.id = attendance.employee_id
    WHERE attendance.date = '$date_now' AND (attendance.status = 'LATE' OR attendance.status = 'ONTIME') AND attendance.schedule_id = '$employee'";
    $result = mysqli_query($conn, $sql);
   
    // check if SELECT statement was successful
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {    
          if($row["time_in"] == "00:00:00"){
            $timeIn = "No time";
          }else{
            $timeIn = date('h:i A', strtotime($row["time_in"]));
          }
          if($row["time_out"] == "00:00:00"){
            $timeOut = "No time";
          }else{
            $timeOut = date('h:i A', strtotime($row["time_out"]));
          }


            if($row["status"] == "ONTIME"){
                $status = '<span class="badge text-bg-success">Ontime</span>';
            }
            else if($row["status"] == "LATE"){
              $status = '<span class="badge text-bg-danger">Late</span>';
            }
            echo "<tr><td>"  . $row["employee_id"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["date"] . "</td><td>" . $timeIn . "</td><td>" . $timeOut . "</td><td>" . $status . "</td><td>" ."</td></tr>";
        }
    } else {
        echo "";
    }

    // close the database connection
    mysqli_close($conn);
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

