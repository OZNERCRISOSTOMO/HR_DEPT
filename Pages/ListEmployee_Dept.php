<!DOCTYPE html>
<html>
<head>
	<title>Employee</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" />
  <!-- SWEET ALERT -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    $conn = mysqli_connect("sql985.main-hosting.eu", "u839345553_sbit3g", "sbit3gQCU", "u839345553_SBIT3G");

    // check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // execute a SELECT statement to retrieve data from the table

   


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
<form method="POST" action="../Functions/leave-function.php">

<div class="container col-10">
    <div class="row">
<div class=" col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Employee ID:</label>
    <input type="text" class="form-control" id="exampleInputname1" name="loginID" aria-describedby="nameHelp">
</div>

<div class="col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Name:</label>
    <input type="text" class="form-control" id="exampleInputname2" name="name" aria-describedby="nameHelp">
</div>

<div class="col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Date Started:</label>
    <input type="date" class="form-control" id="exampleInputname3" name="date_started" aria-describedby="nameHelp">
</div>

<div class="col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Date Ended:</label>
    <input type="date" class="form-control" id="exampleInputname4" name="date_ended"aria-describedby="nameHelp">
</div>


<div class="col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Department:</label>
    <input type="text" class="form-control" id="exampleInputname1" name="department" aria-describedby="deparment">
    </div>

    <div class="col-6 mb-3">
    <label for="exampleInputname1" class="form-label">Description:</label>
    <input type="text" class="form-control" id="exampleInputname1" name="description" aria-describedby="description">
    </div>


    

<div class="col-12 mb-4">
<select  name="leave" class="form-control">
            <option  value="0">Select employee</option>
                    <option value="Vacation Leave">Vacation Leave</option>
                    <option value="Sick Leave">Sick Leave</option>
                    <option value="Maternity Leave">Maternity Leave</option>
                    <option value="Paternity Leave">Paternity Leave</option>
                    <option value="Reason for Absent">Reason for Absent</option>
                    <option value="Notice of Explanation">Notice of Explanation</option>
          </select>

    </div>

   <div class="col-8 text-center  m-auto justify-content-center m-auto">
   <button type="submit" class="btn btn-primary  w-100 " name="submitt">Submit</button>
    </div>
   
 

  </form>

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
<script>
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
</script>