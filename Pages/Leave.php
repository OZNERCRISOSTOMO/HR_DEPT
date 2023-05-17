
<?php

session_start();
$timezone = 'Asia/Manila';
date_default_timezone_set($timezone);
$lognow = date('H:i:s');

if (isset($_SESSION['admin_id'])) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $admin = new Admin($database);

    //get admin data 
    $adminData = $admin->btnPic($_SESSION['admin_id']);

    $conn = mysqli_connect("sql985.main-hosting.eu", "u839345553_sbit3g", "sbit3gQCU", "u839345553_SBIT3G");

    $year = "SELECT * FROM hr_year WHERE id = 1";
    $yquery = $conn->query($year);
    $yrow = $yquery->fetch_assoc();

    $currentYear = date('Y');
    $employees = "SELECT id, gender FROM employees WHERE status = '1'";
    $empquery = $conn->query($employees);

    if($currentYear !== $yrow['year_now']){
      $updateYear = "UPDATE hr_year SET year_now = '$currentYear'";
      $updateQuery = $conn->query($updateYear);

      while($emprow = mysqli_fetch_assoc($empquery)){
        $employee_id = $emprow['id'];
        if($emprow['gender'] == 'male'){
          $updateLeaveBal = "UPDATE employee_details SET vacation_leave = 15, sick_leave = 60, maternity_leave = 0, paternity_leave = 7 WHERE employee_id = $employee_id";
        }elseif($emprow['gender'] == 'female'){
          $updateLeaveBal = "UPDATE employee_details SET vacation_leave = 15, sick_leave = 60, maternity_leave = 90, paternity_leave = 0 WHERE employee_id = $employee_id";
        }

        $conn->query($updateLeaveBal);

      }
    }
}else{
  header("Location: ../index.php");
}



?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../Images/Logo 1.svg">
    <title>Leave</title>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  </head>
  <body style="background-color: #f2f2f2; font-family: Bahnschrift;">
  <div class="container-fluid">
  <div class="row">
  <!------------ SIDEBAR ------------ -->
 <div class="col-2 p-0">
                <?php include("../Components/Sidebar-Left.php")?>
            </div>
        <!---------------------------->
        <div class="col-xl-9 h-100 " >
    <!--Time and Date-->
        <div class="container-fluid d-flex justify-content-center align-items-center mt-4">
            <h5 style="font-weight:bolder;"> 
            <script>                   
            document.write(new Date().toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true, day: 'numeric', month: 'short', year: 'numeric' }).toUpperCase());
            </script>    
            </h5>  
        </div>





<div class="container mb-4">
  <div class="row">

  <div class="col-9">

    <h5>Leave</h5>
</div>

  <div class="col-3">
  
  <button type="button" class="btn btn-success shadow w-100" data-bs-toggle="modal" data-bs-target="#leave"> Leave Balance</button>
        <?php include("../Modals/M-Leave.php")?>  
  </div>

</div>
</div>

<div class="container-fluid">






<table class="table table-striped" id="leave1">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Type</th>
      <th scope="col px-5">Date Started</th>
      <th scope="col px-5">Date Ended</th>
      <th scope="col">Department</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
     
    </tr>
  </thead>
  <tbody>

  <?php
$query = "SELECT * FROM leave_p WHERE status = 0";
$result = mysqli_query($conn, $query);


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
  ?>
<tr>
      <td><?php echo $row['ID']; ?></td>
      <td><?php echo $row['Name']; ?></td>
      <td><?php echo $row['Type']; ?></td>
      <td><?php echo $row['date_started']; ?></td>
      <td><?php echo $row['date_ended']; ?></td>
      <td><?php echo $row['Department']; ?></td>
      <td><?php echo $row['description']; ?></td>
      <td><?php 
        if($row['status'] == 0){
          echo "Pending";
        }else{
          echo "Accepted";
        }
      ?></td>
      <td class="d-flex">
      <form method="post" action="../Functions/leave-accept.php">
          <input type="hidden" name="acceptid" id="acceptid" value=<?php echo $row['ID']; ?>>
          <input type="submit" name="acceptbtn" id="acceptbtn" class="btn btn-sm btn-primary" value="Accept">
      </form>
      <form method="post" action="../Functions/leave-delete.php">
          <input type="hidden" name="deleteid" id="deleteid" value=<?php echo $row['ID']; ?>>
          <input type="submit" name="deletebtn" id="deletebtn" class="btn btn-sm btn-danger" value="Declined">
      </form>
      </td>
</tr>
</form>
  </tbody>
  <?php 
 }
}else{
  
}
?>
</table>
</div>
</div>








</div>
</div>


</div>
   


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script  src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>



<script>
 $(document).ready(function(){
    $('#leave1').DataTable();
  });

  const urlParams = new URLSearchParams(window.location.search);
  const successValue = urlParams.get('value');

  if(successValue === "accepted"){
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
  }else if(successValue === "deleted"){
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
  </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>