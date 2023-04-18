<?php
// start session
session_start();
if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    require '../Classes/employee.php';
    require '../Classes/database.php';

    $database = new Database();
    $attlist = new Employee($database);
} else {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<Title> ATTENDANCE </Title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/53a2b7f096.js" crossorigin="anonymous"></script>
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



<div class="container ">
  <div class="row">

  <div class="col-8 d-flex pr-3">
  <h4 class="fw-bolder">Attendance</h4>
  <button class="btn border-0 border shadow-none border-start-0 mb-1">
    <h4><i class="fa-solid fa-clock-rotate-left"></i></h4>
  </button>
                  </div>


                  <div class="col-4">
   <div class="col-sm input-group">
                        <span class="input-group-text bg-white border border-end-0 border-0">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" class="form-control border-0 border shadow-none border-start-0" id="Search" autocomplete="off">
                    </div>
                  </div>

                  </div>
                  </div>
<!----Table Start--->
  <table class="table table-striped table-borderless align-middle text-center">
    <thead>
      <tr>
        <th>ID</th>
        <th>Employee ID</th>
        <th>Date</th>
        <th>Time IN</th>
        <th>Time OUT</th>
        <th>Status</th>
      </tr>
      </thead>
      <tbody>
      <?php
        $attlist = $attlist->attendanceList();
        foreach($attlist as $list){
      ?>
      <tr>
      <td><?php echo $list['id']; ?> </td>
      <td><?php echo $list['employee_id']; ?> </td>
      <td><?php echo $list['date']; ?> </td>
      <td><?php            
           $time = DateTime::createFromFormat('H:i:s', $list['time_in']);
          $formattedTimeIn = $time->format('h:i:s A'); 
           echo $formattedTimeIn;
            ?>
      </td>  
      <td><?php 
            $time = DateTime::createFromFormat('H:i:s', $list['time_out']);
            $formattedTimeOut = $time->format('h:i:s A'); 
            echo $formattedTimeOut;
          ?> 
      </td>
      <td><?php echo $list['status']; ?> </td>
    </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
<!----Table End--->
</div>
<div>
<table class="table table-striped table-borderless align-middle text-center">
    <thead>
      <tr>
        <th>ID</th>
        <th>Employee ID</th>
        <th>Remarks</th>
        <th>Date</th>
        <th>Over Time</th>
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
        $sql = "SELECT * FROM overTime";
        $query = $conn->query($sql);

        while($row = mysqli_fetch_assoc($query)){

      ?>
      <tr>
      <td><?php echo $row['id']; ?> </td>
      <td><?php echo $row['employee_id']; ?> </td>
      <td><?php echo $row['remarks']; ?> </td>
      <td><?php echo $row['date']; ?> </td>
      <td><?php echo $row['over_time']; ?> </td>
      <td>
      <td><form method="post" action="../Functions/overtime-accept.php">
      <input type="hidden" name="acceptid" id="acceptid" value=<?php echo $row['id']; ?>>
      <input type="submit" name="acceptbtn" id="acceptbtn" class="btn btn-sm btn-primary" value="Accept">
      </form>
      <form method="post" action="../Functions/overtime-delete.php">
      <input type="hidden" name="deleteid" id="deleteid" value=<?php echo $row['id']; ?>>
      <input type="submit" name="deletebtn" id="deletebtn" value="Delete">
      </form>
    </td>
    </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
</div>
</body>
</html>


<script>
  const urlParams = new URLSearchParams(window.location.search);
  const successValue = urlParams.get('value');

  if(successValue === "accept"){
    Swal.fire({
		icon:'success',
    position:'top-end',
		title:'Over Time of the Employee was Accepted',
		toast:true,
		showConfirmButton: false,
  		timer: 3000,
  		timerProgressBar: true,
		didOpen: (toast) => {
    	toast.addEventListener('mouseenter', Swal.stopTimer)
    	toast.addEventListener('mouseleave', Swal.resumeTimer)
  		}
	})
  setTimeout(function(){
    window.history.back();
   },5000);
  }else if(successValue === "delete"){
    Swal.fire({
		icon:'danger',
    position:'top-end',
		title:'Over Time of the Employee was Decline',
		toast:true,
		showConfirmButton: false,
  		timer: 3000,
  		timerProgressBar: true,
		didOpen: (toast) => {
    	toast.addEventListener('mouseenter', Swal.stopTimer)
    	toast.addEventListener('mouseleave', Swal.resumeTimer)
  		}
	})
  setTimeout(function(){
    window.history.back();
   },5000);
  }
</script>