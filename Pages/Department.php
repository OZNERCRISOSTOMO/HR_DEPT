<!DOCTYPE html>
<html>
<head>
	<title>Bootstrap Table Example</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h2>Attendance Monitoring</h2>
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
    

    // execute a SELECT statement to retrieve data from the table
    $timezone = 'Asia/Manila';
	date_default_timezone_set($timezone);
    $date_now = date('Y-m-d');
    $sql = "SELECT employees.first_name, employees.last_name, attendance.*
    FROM employees
    JOIN employee_details ON employees.id = employee_details.employee_id
    JOIN attendance ON employees.id = attendance.employee_id
    WHERE employee_details.department = 'sales' AND attendance.date = '$date_now'";
    $result = mysqli_query($conn, $sql);

    // check if SELECT statement was successful
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>"  . $row["employee_id"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["date"] . "</td><td>" . $row["time_in"] . "</td><td>" . $row["time_out"] . "</td><td>" . $row["status"] . "</td><td>" ."</td></tr>";
        }
    } else {
        echo "0 results";
    }

    // close the database connection
    mysqli_close($conn);
?>

			</tbody>
		</table>
	</div>
</body>
</html>
