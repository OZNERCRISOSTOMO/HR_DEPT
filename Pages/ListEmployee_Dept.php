<!DOCTYPE html>
<html>
<head>
	<title>Employee</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h2>Employee List</h2>

<button type="button" class="btn btn-primary">Primary</button>

<button type="button" class="btn btn-primary">Primary</button>


		<table class="table table-striped">
			<thead>
				<tr>
					
			<th>Employee ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
			<th>Email</th>
            <th>Gender</th>
            <th>Schedule</th>
            <th>Contact</th>
            <th>Department</th>
            <th>Action</th>
          


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

    // execute a SELECT statement to retrieve data from the table

    $sql = "SELECT employees.*, employee_details.department
    FROM employees
    JOIN employee_details ON employees.id = employee_details.employee_id
    WHERE employee_details.department = 'sales'";
    $result = mysqli_query($conn, $sql);

    $schedule = "";
    // check if SELECT statement was successful
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row["schedule_id"] == '1') {
                $schedule = "8:00AM - 5:00PM";
            } 
            elseif ($row["schedule_id"] == '2') {
                $schedule = "5:00PM - 10:00PM";  
            } 
            
            echo "<tr><td>"  . $row["id"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["gender"] . "</td><td>" . $schedule . "</td><td>" . $row["contact"] . "</td><td>" . $row["department"] . '</td><td> <button type="button" class="btn btn-primary">Set Schedule</button> </td></tr>';

       
        }
    } else {
        echo "0 results";
    }
    // close the database connection
    mysqli_close($conn);
?>

			</tbody>
		</table>
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scheduleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

	</div>


    

</body>
</html>
