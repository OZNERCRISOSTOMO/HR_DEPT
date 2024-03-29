<?php
// start session
session_start();
if (isset($_SESSION['admin_id'])) {
    require '../Classes/employee.php';
    require '../Classes/database.php';
    require '../Classes/admin.php';

    $database = new Database();
    $attlist = new Employee($database);
    $admin = new Admin($database);

       //get admin data 
    $adminData = $admin->btnPic($_SESSION['admin_id']);

    $timezone = 'Asia/Manila';
	  date_default_timezone_set($timezone);
    $lognow = date('H:i:s');
} else {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<Title> Attendance</Title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../Images/Logo 1.svg">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/53a2b7f096.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

 <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="background-color: #f2f2f2; font-family: Bahnschrift;">

<div class="container-fluid ">
      <div class="row">

<!------------ SIDEBAR ------------ -->
<div class="col-2 p-0">
               <?php include("../Components/Sidebar-Left.php") ?>
            </div>
        <!---------------------------->


        <div class="col-xl-9 h-100 " >
<!--Time and Date-->
<div class="container-fluid d-flex justify-content-center align-items-center mt-4">
                <h5 style="font-weight:bolder;"> 
                <script>                   
                    function updateTime() {
                    const now = new Date();
                    const date = now.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                    const time = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                    document.getElementById('datetime').textContent = `${date} ${time}`;
                    }

                    setInterval(updateTime, 1000);

                </script> 
                <span id="datetime"></span>  
                </h5>  
            </div>
            <!------End----->



  <div div class="container ">
    <div class="row">
      <h4><b>Attendance</b></h4>
      <div class="col-8 d-flex pr-3">
  
                  </div>

                  </div>
                  </div>

                  <div class="container mt-2">
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link text-dark active" href="#tab1" data-bs-toggle="tab">History</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-dark" href="#tab2" data-bs-toggle="tab">Overtime/Undertime</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-dark" href="#tab3" data-bs-toggle="tab">Presents Today</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-dark" href="#tab4" data-bs-toggle="tab">Absents Today</a>
                      </li>
                    </ul>

 <!------------ Table 1 History------------ -->

      <div class="tab-content mt-2 mb-2">
        <div class="tab-pane fade show active" id="tab1">

        <table id="history" class="table table-striped table-borderless align-middle text-center">
    <thead>
      <tr>
        <th style="white-space: nowrap;">Employee ID</th>
        <th>Name</th>
        <th>Date</th>
        <th style="white-space: nowrap;">Time In</th>
        <th style="white-space: nowrap;">Time Out</th>
        <th>Status</th>
      </tr>
      </thead>
      <tbody>
      <?php
        $attlist = $attlist->attendanceList();
        foreach($attlist as $list){
      ?>
      <tr>
      <td><?php echo $list['employee_id']; ?> </td>
      <td><?php echo $list['Name']; ?> </td>
      <td><?php echo $list['date']; ?> </td>
      <td><?php
      if($list['time_in'] == "00:00:00"){
        echo "No Record";
      }else{
        $time = DateTime::createFromFormat('H:i:s', $list['time_in']);
          $formattedTimeIn = $time->format('h:i:s A'); 
           echo $formattedTimeIn;
      }            
            ?>
      </td>  
      <td><?php 
      if($list['time_out'] == "00:00:00"){
        echo "No Record";
      }else{
        $time = DateTime::createFromFormat('H:i:s', $list['time_out']);
            $formattedTimeOut = $time->format('h:i:s A'); 
            echo $formattedTimeOut;
      }          
          ?> 
      </td>
   
      <td><?php echo $list['status']; ?> </td>
    </tr>
    <?php
      }
    ?>
    </tbody>
    </table>
    
    
        </div>


         <!------------ Table 2 Overtime / Undertime------------ -->
        <div class="tab-pane fade" id="tab2">
        <table id="overtime" class="table table-striped table-borderless align-middle text-center mb-2">
    <thead>
      <tr>
        <th style="white-space: nowrap;">Employee ID</th>
        <th>Name</th>
        <th>Department</th>
        <th>Remarks</th>
        <th class="px-5">Date</th>
        <th>Overtime</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php
        $dbServername = "sql985.main-hosting.eu";
        $dbUsername = "u839345553_sbit3g";
        $dbPassword = "sbit3gQCU";
    
        $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');
        $date = new DateTime();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        //"SELECT employees.*, employee_details.department FROM employees JOIN employee_details ON employees.id = employee_details.employee_id";
        $sql = "SELECT overTime.*, employee_details.department FROM overTime JOIN employee_details ON overTime.employee_id = employee_details.employee_id";
        $query = $conn->query($sql);

        while($row = mysqli_fetch_assoc($query)){

          if ($row['department'] == 'human-resource'){
            $dept = "Human Resource";
          }
          else if ($row['department'] == 'sales'){
            $dept = "Sales";
          }
          else if ($row['department'] == 'warehouse'){
            $dept = "Warehouse";
          }
          else {
            $dept = "Purchaser";
          }

      ?>
      <tr>
      <td><?php echo $row['employee_id']; ?> </td>
      <td ><?php echo $row['Name']; ?> </td>
      <td ><?php echo $dept; ?> </td>
      <td><?php echo $row['remarks']; ?> </td>
      <td><?php echo $row['date']; ?> </td>
      <td><?php echo $row['over_time']; ?> </td>
      <td>
      <div class="d-flex justify-content-center">
      <form method="post" action="../Functions/overtime-accept.php">
          <input type="hidden" name="acceptid" id="acceptid" value=<?php echo $row['id']; ?>>
          <button type="submit" name="acceptbtn" id="acceptbtn" class="btn btn-sm btn-primary me-2 d-flex justify-content-center align-items-center"><i class="fa-solid fa-check me-2"></i>Accept</button>
      </form>
      <form method="post" action="../Functions/overtime-delete.php">
          <input type="hidden" name="deleteid" id="deleteid" value=<?php echo $row['id']; ?>>
          <button type="submit" name="deletebtn" id="deletebtn" class="btn btn-sm btn-danger me-2  d-flex justify-content-center align-items-center"><i class="fa-solid fa-xmark me-2"></i>Decline</button>
      </form>
        </div>
      </td>
    </tr>
    <?php
      }
?>
    </tbody>
  </table>
        </div>
 <!------------ Table 2 End ------------ -->

 <!------------ Table 3 Present Today------------ -->
        <div class="tab-pane fade" id="tab3">
        <table id="recents" class="table table-striped">
			<thead>
				<tr>
					
			     <th style="white-space: nowrap;">Employee ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Department</th>
		      	<th>Date</th>
            <th style="white-space: nowrap;">Time In</th>
            <th style="white-space: nowrap;">Time Out</th>
            <th>Status</th>
        
          
				</tr>
			</thead>
			<tbody>
			<?php
    
    if($lognow < "15:30:00"){
      $employee = '1';
  }else if($lognow > "15:30:00"){
      $employee = '2';
  }
    // execute a SELECT statement to retrieve data from the table
    $timezone = 'Asia/Manila';
	date_default_timezone_set($timezone);
    $date_now = date('Y-m-d');
    $sql = "SELECT employees.first_name, employees.last_name, attendance.*, employee_details.department
    FROM employees
    JOIN employee_details ON employees.id = employee_details.employee_id
    JOIN attendance ON employees.id = attendance.employee_id
    WHERE employee_details.department = employee_details.department AND attendance.date = '$date_now' AND attendance.schedule_id = $employee AND (attendance.status = 'LATE' OR attendance.status = 'ONTIME' OR attendance.status = 'VACATION LEAVE' OR attendance.status = 'MATERNITY LEAVE' OR attendance.status = 'PATERNITY LEAVE')";
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

            echo "<tr><td>"  . $row["employee_id"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] . "</td><td>" . $dept . "</td><td>" . $row["date"] . "</td><td>" . $timeIn . "</td><td>" . $timeOut . "</td><td>" . $row["status"] . "</td></tr>";
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
 <!------------ Table 3 End ------------ -->

  <!------------ Table 4 Overtime / Undertime------------ -->
        <div class="tab-pane fade" id="tab4">
        <table id="absents" class="table table-striped">
			<thead>
				<tr>
					
			      <th>Employee ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Department</th>
            <th>Status</th>
        
          
				</tr>
			</thead>
			<tbody>
      <?php

    if($lognow < "15:30:00"){
        $employee = $admin->selectEmployeeSched('1');
    }else if($lognow > "15:30:00"){
        $employee = $admin->selectEmployeeSched('2');
    }

            $count = 0;
            foreach ($employee as $sched) {
                foreach ($sched as $key => $value) {

                //check in attendance if exist 
                $valueEmployee = $admin->checkAttendance($value);
                $employeeD = $admin->getEmployeeDetails($value);
                if(!$valueEmployee){
                    $count++;
                    $employeeInfo = $admin->findEmployeeById($value);
              if (!empty($employeeInfo)) {
                if($employeeD[0]['department'] == "human-resource"){
                  $dept = "Human Resource";
                }
                else if($employeeD[0]['department']  == "sales"){
                  $dept = "Sales";
                }
                else if($employeeD[0]['department'] == "warehouse"){
                  $dept = "Warehouse";
                }
                else {
                  $dept = "Purchaser";
                }
                echo "<tr><td>".$employeeInfo[0]['id']."</td>";
                echo "<td>".$employeeInfo[0]['first_name']."</td>";
                echo "<td>".$employeeInfo[0]['last_name']."</td>";
                echo "<td>".$dept."</td>";
                echo '<td>Absent</td>';
              
                }
            }

    }
}
?>
      </tbody>
		</table>
        

    </div>
 <!------------ Table 4 End ------------ -->


      </div>
      
    </div>
</ul>

    </div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script  src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
 $(document).ready(function(){
    $('#history').DataTable();
  });

  $(document).ready(function(){
    $('#overtime').DataTable();
  });

  $(document).ready(function(){
    $('#recents').DataTable();
  });
  $(document).ready(function(){
    $('#absents').DataTable();
  });
  
  
  
  </script>
</body>
</html>


<script>
  const urlParams = new URLSearchParams(window.location.search);
  const successValue = urlParams.get('value');

  if(successValue === "accept"){
    Swal.fire({
		icon:'success',
    position:'top-end',
		title:'Accepted',
		toast:true,
		showConfirmButton: false,
  		timer: 3000,
  		timerProgressBar: true,
		didOpen: (toast) => {
    	toast.addEventListener('mouseenter', Swal.stopTimer)
    	toast.addEventListener('mouseleave', Swal.resumeTimer)
  		}
	})
  }else if(successValue === "delete"){
    Swal.fire({
		icon:'error',
    position:'top-end',
		title:'Declined',
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

  const logoutBtn = document.querySelector(".logout");

  // SWEET ALERT CONFIRMATION FOR LOGOUT
logoutBtn.addEventListener("click", function (e) {
  e.preventDefault();

  Swal.fire({
    title: "Are you sure?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Log me out",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      // e.target.href
      // console.log(e.target.closest(".logout").href)
      window.location.href = `${e.target.closest(".logout").href}`;
    }
  });
});


 
</script>