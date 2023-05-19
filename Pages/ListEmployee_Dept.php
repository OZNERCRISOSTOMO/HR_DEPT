<?php
   // establish a connection to the MySQL database
    $conn = mysqli_connect("sql985.main-hosting.eu", "u839345553_sbit3g", "sbit3gQCU", "u839345553_SBIT3G");

    // check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


  // Get employee details 
  if (isset($_POST['id'])) {
    $employeeId = $_POST['id'];

    // Get employee details from the database based on the employeeId
    $getEmployee = "SELECT employee_login.*, employee_details.department FROM employee_login 
                    INNER JOIN employee_details ON employee_login.employee_id = employee_details.employee_id
                    WHERE employee_login.employee_id = '$employeeId'";
    $result = mysqli_query($conn, $getEmployee);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    // Create an empty array to store the employee details
    $employeeData = array();

    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch and store the employee details
        $employeeData = mysqli_fetch_assoc($result);
    } else {
        echo "No results found";
    }
    
    // Convert the employeeData array to JSON
    $jsonResponse = json_encode($employeeData);

    if ($jsonResponse === false) {
        // JSON encoding failed
        die("Error encoding JSON response");
    }

    header('Content-Type: application/json');
    echo $jsonResponse;
    exit; // Make sure to exit after sending the JSON response
}

  if (isset($_POST['submit'])){
        $name = isset($_POST['employee-name']) ? $_POST['employee-name'] : null;
        $loginID = isset($_POST['loginID']) ? $_POST['loginID'] : null;
        $date_start = isset($_POST['date_started']) ? $_POST['date_started'] : null;
        $date_end = isset($_POST['date_ended']) ? $_POST['date_ended'] : null;
        $leave_type = isset($_POST['leave']) ? $_POST['leave'] : null;
        $dept = isset($_POST['department']) ? $_POST['department'] : null;
        $des = isset($_POST['description']) ? $_POST['description'] : null;
        $employee_id =  $_POST['employee-id'];

            // echo $name;
            // echo "</br>";
            //  echo $loginID;
            // echo "</br>";
            //  echo $date_started;
            // echo "</br>";
            //  echo $date_ended;
            // echo "</br>";
            //  echo $leave;
            // echo "</br>";
            //  echo $department;
            // echo "</br>";
            //  echo $description;
            // echo "</br>";
            // echo $employeeId;
            // echo "</br>";

             //check department if has more than 3 leave 
            $selectDepartment = "SELECT COUNT(department) FROM leave_p WHERE Department = '$dept'";
            $resultDepartment = mysqli_query($conn, $selectDepartment);
            
            $count = 0;

            if ($resultDepartment) {
                $row = mysqli_fetch_assoc($resultDepartment);
                $count = $row['COUNT(department)'];
            } else {
                echo "Query failed.";
            }

            if($count >= 3){
                $url = "ListEmployee_Dept.php?value=invalid";
                header("Location: $url");
            }else{

             $diff_absent = "SELECT DATEDIFF('$date_end', '$date_start') AS days, sick_leave, vacation_leave FROM employee_details WHERE employee_id = '$employee_id'";
                $diff_query = $conn->query($diff_absent);
                $diff_row = $diff_query->fetch_assoc();

                if($leave_type == "Sick Leave"){
                    if($diff_row['sick_leave'] >= $diff_row['days']){ 
                    $insert_leave = "INSERT INTO leave_p (name, type, date_started, date_ended, employee_id, Department, description) VALUES ('$name', '$leave_type', '$date_start', '$date_end', '$employee_id', '$dept', '$des')";
                    $insert_query = $conn->query($insert_leave);

                    header('Location: ListEmployee_Dept.php?value=insert');
                }else{
                    header('Location: ListEmployee_Dept.php?value=invalid');
                }
            }else if($leave_type == "Vacation Leave"){
                if($diff_row['vacation_leave'] >= $diff_row['days']){
                    $insert_leave = "INSERT INTO leave_p (name, type, date_started, date_ended, employee_id, Department, description) VALUES ('$name', '$leave_type', '$date_start', '$date_end', '$employee_id', '$dept', '$des')";
                    $insert_query = $conn->query($insert_leave);

                    header('Location: ListEmployee_Dept.php?value=insert');
                }else{
                    header('Location: ListEmployee_Dept.php?value=invalid');
                }
            }else if($leave_type == "Maternity Leave"){
                if($diff_row['maternity_leave'] >= $diff_row['days']){
                    $insert_leave = "INSERT INTO leave_p (name, type, date_started, date_ended, employee_id, Department, description) VALUES ('$name', '$leave_type', '$date_start', '$date_end', '$employee_id', '$dept', '$des')";
                    $insert_query = $conn->query($insert_leave);

                    header('Location: ListEmployee_Dept.php?value=insert');
                }else{
                    header('Location: ListEmployee_Dept.php?value=invalid');
                }
            }else if($leave_type == "Paternity Leave"){
                if($diff_row['paternity_leave'] >= $diff_row['days']){
                    $insert_leave = "INSERT INTO leave_p (name, type, date_started, date_ended, employee_id, Department, description) VALUES ('$name', '$leave_type', '$date_start', '$date_end', '$employee_id', '$dept', '$des')";
                    $insert_query = $conn->query($insert_leave);

                    header('Location: Pages/ListEmployee_Dept.php?value=insert');
                }else{
                    header('Location: Pages/ListEmployee_Dept.php?value=invalid');
                }
            }else{
                $insert_leave = "INSERT INTO leave_p (name, type, date_started, date_ended, employee_id, Department, description) VALUES ('$name', '$leave_type', '$date_start', '$date_end', '$employee_id', '$dept', '$des')";
                $insert_query = $conn->query($insert_leave);
                header('Location: ListEmployee_Dept.php?value=insert');
        }
            
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Employee</title>
      <!-- Boostrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>

    <!-- Select2 CSS --> 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
    <!-- jQuery --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <!-- Select2 JS --> 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

  <!-- SWEET ALERT -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
      /* .select2-container {
     
              z-index: 1050;
        }

        .modal {
        z-index: 150;
        }
        .modal-backdrop.show {
    z-index: 100;
} */

  .select2-container {
    z-index: 2000; 
  }

  .modal {
    z-index: 1050;
  }

    </style>
  </head>
 
<body>
	<div class="container">

  <div class="d-flex py-4">
		<h2 class="pe-2">Employee List</h2>
    <button type="button" class="btn btn-primary shadow" data-bs-toggle="modal" data-bs-target="#exampleModal1">
  File Leave
</button>
</div>




		<table class="table table-striped">
			<thead>
				<tr>
					
			    <th>Employee ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
		    	<th>Email</th>
            <th>Gender</th>
            <th>Schedule</th>
            <th>Position</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
    // establish a connection to the MySQL database
    // $conn = mysqli_connect("sql985.main-hosting.eu", "u839345553_sbit3g", "sbit3gQCU", "u839345553_SBIT3G");

    // // check if connection was successful
    // if (!$conn) {
    //     die("Connection failed: " . mysqli_connect_error());
    // }

    // execute a SELECT statement to retrieve data from the table
     // Get all employees

    $getEmployees = "SELECT * FROM employees WHERE status = '1'";
    $resultEmployees = mysqli_query($conn, $getEmployees);

    if (!$resultEmployees) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    // Create an empty array to store the results
    $employees = array();


    // Check if there are any rows returned
    if (mysqli_num_rows($resultEmployees) > 0) {
    // Fetch and store each row in the array
    while ($row = mysqli_fetch_assoc($resultEmployees)) {
        $employees[] = $row;
    }
    } else {
        echo "No results found";
    }
   

    $sql = "SELECT employees.*, employee_details.department_position ,employee_details.employee_id As empid
    FROM employees
    JOIN employee_details ON employees.id = employee_details.employee_id
    WHERE employee_details.department = 'purchaser'";
    $result = mysqli_query($conn, $sql);

    $dateString = date('Y-m-d');
   
    $schedule = "";
    // check if SELECT statement was successful
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
          $sql1 = "SELECT * FROM attendance WHERE employee_id = '".$row['empid']."' AND date='$dateString' AND (status = 'ONTIME' OR status = 'LATE' OR status = 'VACATION LEAVE' OR status = 'MATERNITY LEAVE' OR status = 'PATERNITY LEAVE')";
          $result1 = $conn->query($sql1);
          $row1 = $result1->fetch_assoc();

         
          if($result1->num_rows > 0){
          if ($row1["status"] == 'ONTIME' || $row1["status"] == 'LATE'){
            $status = "PRESENT";
          }
          elseif ($row1["status"] == 'VACATION LEAVE'){
            $status = "VACATION LEAVE";
          }
          elseif ($row1["status"] == 'MATERNITY LEAVE'){
            $status = "MATERNITY LEAVE";
          }
          elseif ($row1["status"] == 'PATERNITY LEAVE'){
            $status = "PATERNITY LEAVE";
          }
        }else{
          $status = "ABSENT";
        }

          

            if ($row["schedule_id"] == '1') {
                $schedule = "7:00AM - 3:00PM";
            } 

            else if ($row["schedule_id"] == '2') {
                $schedule = "3:00PM - 11:00PM";  
            } 
           ?>
            <tr>
                <td><?php echo $row["id"]?></td>
                <td><?php echo $row["first_name"]?></td>
                <td><?php echo $row["last_name"]?></td>
                <td><?php echo $row["email"]?></td>
                <td><?php echo $row["gender"]?></td>
                <td><?php echo $schedule?></td>
                <td><?php echo $row["department_position"]?></td>
                <td><?php echo $dateString?></td>
                <td><?php echo $status?></td>
                <td><input type="hidden" name="card-number" value=<?php echo $row['id']?>>
                <button type="button" onclick="location.href='../Pages/setschedule.php?id=<?php echo $row['id']?>'" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                Set Schedule
              </button>
            </td>
          </tr>
<?php } } ?>

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
<form method="POST" action="ListEmployee_Dept.php">

<div class="container col-10">
    <div class="row">
<div class=" col-6 mb-3 select2-container">
    <label for="exampleInputname1" class="form-label">Name:</label>
    <select id='select-employee' name="employee-name" class="select2-container form-control">
                                <option value="0">Select employee</option>
                 <?php
  
                     foreach($employees as $employee){
    echo "<option value='" . $employee['first_name'] . " " . $employee['last_name'] . "' data-employee-id='" . $employee['id'] . "'>" . $employee['first_name'] . " " . $employee['last_name'] . "</option>";
                    }
                ?>          
    </select>
</div>

<div class="col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Employee ID:</label>
    <input type="text" class="form-control" id="loginID-disabled" name="name" aria-describedby="nameHelp" disabled>
    <input type="hidden" class="form-control" id="loginID" name="loginID" aria-describedby="nameHelp">
</div>

<div class="col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Date Started:</label>
    <input type="date" class="form-control" id="date-started" name="date_started" aria-describedby="nameHelp">
</div>

<div class="col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Date Ended:</label>
    <input type="date" class="form-control" id="date-ended" name="date_ended"aria-describedby="nameHelp">
</div>


<div class="col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Department:</label>
    <input type="text" class="form-control" id="department-disabled" name="department" aria-describedby="deparment" disabled>
     <input type="hidden" class="form-control" id="department" name="department" aria-describedby="deparment">
    </div>

    <div class="col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Reason:</label>
    <input type="text" class="form-control" id="exampleInputname1" name="description" aria-describedby="description">
    </div>


    

<div class="col-12 mb-4">
<select  name="leave" class="form-control" id="leave-dropdown">
            <option  value="0">Type of Leave</option>
                    <option value="Vacation Leave">Vacation Leave</option>
                    <option value="Sick Leave">Sick Leave</option>
                    <option value="Maternity Leave">Maternity Leave</option>
                    <option value="Paternity Leave">Paternity Leave</option>
                    <option value="Reason for Absent">Reason for Absent</option>
                    <option value="Notice of Explanation">Notice of Explanation</option>
          </select>

    </div>

   <div class="col-8 text-center  m-auto justify-content-center m-auto">
     <input type="hidden" name="employee-id" id="employee-id">
   <button type="submit" class="btn btn-primary  w-100 " name="submit">Submit</button>
    </div>
   
 

  </form>

  </div>
      
    </div>
  </div>
</div>

 
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->


<script>

</script>

<script>
   $('#select-employee').select2();

    const urlParams = new URLSearchParams(window.location.search);
    const successValue = urlParams.get('value');
    console.log(successValue);

if(successValue === "invalidUser"){
	Swal.fire({
		icon:'error',
		title:'User Not Found',
		toast:true,
		position:'top-end',
		showConfirmButton: false,
  		timer: 3000,
  		timerProgressBar: true,
		didOpen: (toast) => {
    	toast.addEventListener('mouseenter', Swal.stopTimer)
    	toast.addEventListener('mouseleave', Swal.resumeTimer)
  		}
	});
}else if(successValue === "insert"){
	Swal.fire({
		icon:'success',
		title:'File Leave Successfully!',
		toast:true,
		position:'top-end',
		showConfirmButton: false,
  		timer: 3000,
  		timerProgressBar: true,
		didOpen: (toast) => {
    	toast.addEventListener('mouseenter', Swal.stopTimer)
    	toast.addEventListener('mouseleave', Swal.resumeTimer)
  		}
	});
}else if(successValue === "invalid"){
	Swal.fire({
		icon:'error',
		title:'File Leave Error!',
		toast:true,
		position:'top-end',
		showConfirmButton: false,
  		timer: 3000,
  		timerProgressBar: true,
		didOpen: (toast) => {
    	toast.addEventListener('mouseenter', Swal.stopTimer)
    	toast.addEventListener('mouseleave', Swal.resumeTimer)
  		}
	});
}else if(successValue === "prior"){
    Swal.fire({
		icon:'error',
    position:'top-end',
		title:'Error: 7 Days Prior',
		toast:true,
		showConfirmButton: false,
  		timer: 3000,
  		timerProgressBar: true,
		didOpen: (toast) => {
    	toast.addEventListener('mouseenter', Swal.stopTimer)
    	toast.addEventListener('mouseleave', Swal.resumeTimer)
  		}
	})
  }

  //   Get the input element
  var dateStarted = document.getElementById('date-started');
  var dateEnded = document.getElementById('date-ended');
  var leaveDropdown = document.getElementById('leave-dropdown');

  // Calculate the minimum date
  var currentDate = new Date();
  var minimumDate = new Date(currentDate);
  minimumDate.setDate(currentDate.getDate() + 7); // Add 7 days

  // Set the minimum date for the input
  var minimumDateString = minimumDate.toISOString().split('T')[0];
  dateStarted.setAttribute('min', minimumDateString);
dateEnded.setAttribute('min', minimumDateString);

// Add event listener for dropdown change
leaveDropdown.addEventListener('change', function() {
    var selectedValue = leaveDropdown.value;
    
    if (selectedValue === 'Sick Leave') {
        dateStarted.removeAttribute('min');
        dateEnded.removeAttribute('min');
    } else {
        var currentDate = new Date();
        var minimumDate = new Date(currentDate);
        minimumDate.setDate(currentDate.getDate() + 7); // Add 7 days

        var minimumDateString = minimumDate.toISOString().split('T')[0];
        dateStarted.setAttribute('min', minimumDateString);
        dateEnded.setAttribute('min', minimumDateString);
    }
});

 $('#select-employee').on('change', function() {
    var selectedOption = $(this).find('option:selected');
    var employeeId = selectedOption.data('employee-id');
    console.log(employeeId);

    $.ajax({
        url: window.location.href, // Use current URL
        type: "POST",
        data: {
            id: employeeId,
        },
        success: function(data) {
            try {
                console.log(data)
                //login id 
                $('#loginID-disabled').val(data.login_id);
                $('#loginID').val(data.login_id);

                //department
                $('#department-disabled').val(data.department);
                $('#department').val(data.department);

                //employee id 
                $('#employee-id').val(data.employee_id)

            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
});


</script>
</body>
</html>
