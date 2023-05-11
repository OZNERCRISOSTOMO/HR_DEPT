<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <div class="modal fade" id="presentModal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel1">Presents</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          <div class="container">
		<h2 class="text-center py-2">Attendance Monitoring</h2>
		<table class="table table-striped" id="present">
			<thead>
				<tr>
					
			<th>Employee ID</th>
      <th>Firstname</th>
      <th>Lastname</th>
			<th>Date</th>
      <th>Time In</th>
      <th>Time Out</th>
      <th>Department</th>
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


    if($lognow < "15:30:00"){
      $employee = '1';
  }else if($lognow > "15:30:00"){
      $employee = '2';
  }



    // execute a SELECT statement to retrieve data from the table
    $sql = "SELECT employees.first_name, employees.last_name, attendance.*, employee_details.department
    FROM employees
    JOIN employee_details ON employees.id = employee_details.employee_id
    JOIN attendance ON employees.id = attendance.employee_id
    WHERE attendance.date = '$date_now' AND (attendance.status = 'LATE' OR attendance.status = 'ONTIME' OR attendance.status = 'VACATION LEAVE' OR attendance.status = 'MATERNITY LEAVE' OR attendance.status = 'PATERNITY LEAVE') AND attendance.schedule_id = '$employee'";
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
            }else if($row["status"] == "VACATION LEAVE"){
              $status = '<span class="badge text-bg-danger">Leave</span>';
            }

            if($row["department"] == "human-resource"){
              $dept = "Human Resources";
            }
            else if($row["department"] == "sales"){
              $dept = "Sales";
            }
            else if($row["department"] == "warehouse"){
              $dept = "Warehouse";
            }
            else{
              $dept = "Purchaser";
            }
            echo "<tr><td>"  . $row["employee_id"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["date"] . "</td><td>" . $timeIn . "</td><td>" . $timeOut . "</td><td>" . $dept."</td><td>" . $status . "</td></tr>";
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

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script  src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
 $(document).ready(function(){
    $('#present').DataTable();
  });

 
  
  
  
  </script>