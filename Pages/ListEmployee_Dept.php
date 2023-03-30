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
		<h2>Employee List</h2>
		<table class="table table-striped">
			<thead>
				<tr>
					
			<th>Employee ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
			<th>Email</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Department</th>
        
          
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

    // check if SELECT statement was successful
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>"  . $row["id"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["gender"] . "</td><td>" . $row["address"] . "</td><td>" . $row["contact"] . "</td><td>" . $row["department"] . "</td><td>" ."</td></tr>";
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
