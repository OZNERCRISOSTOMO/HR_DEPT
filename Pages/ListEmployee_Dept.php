<!DOCTYPE html>
<html>
<head>
	<title>Employee</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" />

  </head>
 
<body>
	<div class="container">
		<h2>Employee List</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
        <!-- Button trigger modal -->


        <!-- Button trigger modal -->

<!-- Modal Employee -->
      

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        


      <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Type</th>
      <th scope="col">Date Started</th>
      <th scope="col">Date Ended</th>
      <th scope="col">File Leave</th>
      <th scope="col">Action</th>
    </tr>
  </thead>


  <tbody>
  <form method="POST">
  <?php

$query = "SELECT * FROM `leave` ";
$result = mysqli_query($conn, $query);


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>{$row['ID']}</td><td>{$row['Name']}</td><td>{$row['Type']}</td><td>{$row['date_started']}</td><td>{$row['date_ended']}</td><td>{$row['leave_file']}</td><td><div class='container d-flex gap-2'>
        <button type='submit' name='accept' class='btn btn-success btn-sm w-100 pd-2'>Accept</button>
        <button type='button' class='btn btn-danger btn-sm  w-100'>Decline</button>
        <input type='hidden' name='employee_id' value='{$row['ID']}'></input>
        </div></td></tr>";
    }
} else {
    echo "0 results";
}


if (isset($_POST['accept'])){
  $employee_id = $_POST['employee_id'];

  $updateStat = "UPDATE `leave` SET status = 'accepted' WHERE ID = '$employee_id'";
  $query1 = $conn->query($updateStat);

  echo $employee_id;

}
    
  ?>

</form>
  </tbody>
</table>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
                         
  </form>
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
