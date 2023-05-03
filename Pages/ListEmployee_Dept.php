<!DOCTYPE html>
<html>
<head>
	<title>Employee</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" />

  </head>
 
<body>
	<div class="container">
		<h2>Employee List</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
  Leave
</button>




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
          $sql = "SELECT * FROM schedule WHERE id = '".$row['id']."'";

            if ($row["schedule_id"] == '1') {
                $schedule = "8:00AM - 4:00PM";
            } 

            else if ($row["schedule_id"] == '2') {
                $schedule = "4:00PM - 10:00PM";  
            } 
            
            echo "<tr><td>"  . $row["id"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["gender"] . "</td><td>" . $schedule . "</td><td>" . $row["contact"] . "</td><td>" . $row["department"] . '</td><td> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
            Set Schedule
          </button></td></tr>';

       
        }
    } else {
        echo "0 results";
    }
    // close the database connection
    // mysqli_close($conn); 
?>

			</tbody>
		</table>
    




<!-- Modal Leave -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">File Leave</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        

      <h3 class="text-center pt-4">File Leave</h3>
<form method="POST" action="ListEmployee_Dept.php" enctype="multipart/form-data">

<div class="container col-10">
    <div class="row">
<div class=" col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Name:</label>
    <input type="text" class="form-control" id="exampleInputname1" name="name" aria-describedby="nameHelp">
</div>

<div class="col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Login ID:</label>
    <input type="text" class="form-control" id="exampleInputname2" name="loginID" aria-describedby="nameHelp">
</div>

<div class="col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Date Started:</label>
    <input type="date" class="form-control" id="exampleInputname3" name="date_started" aria-describedby="nameHelp">
</div>

<div class="col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Date Ended:</label>
    <input type="date" class="form-control" id="exampleInputname4" name="date_ended"aria-describedby="nameHelp">
</div>



<div class="col-6 mb-4">
    <div class="form-label">
    <label class="form-check-label" for="inlineRadio1">Type: </label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="leave" id="inlineRadio1" value="Vacation Leave">
    <label class="form-check-label" for="inlineRadio1">Vacation Leave</label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="leave" id="inlineRadio2" value="Sick Leave">
    <label class="form-check-label" for="inlineRadio2">Sick Leave</label>
    </div>

    </div>


    <div class="col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Department:</label>
    <input type="text" class="form-control" id="exampleInputname1" name="department" aria-describedby="deparment">
    </div>

 
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>

 

</div>
</div>
  </form>

  </div>
      
    </div>
  </div>
</div>


<!-- Modal Schedule -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST">
                              Schedule : 
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" value="1" id="1" name="schedule" required>
                                    <label class="form-check-label" for="1">8:00 AM - 5:00 PM</label>
                                </div>
            
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" value="2" id="2" name="schedule" required>
                                    <label class="form-check-label" for="2">6:00 PM - 10:00 PM</label>
                                </div>
                         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




	</div>

 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>

<script>

</script>

</body>
</html>
