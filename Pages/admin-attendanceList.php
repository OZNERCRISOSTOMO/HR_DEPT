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



  <div div class="container ">
    <div class="row">
      <h4 class="fw-bolder">Attendance</h4>
      <div class="col-8 d-flex pr-3">
  
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

                  <div class="container mt-4">


      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" href="#tab1" data-bs-toggle="tab">History</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#tab2" data-bs-toggle="tab">Over/Undertime</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#tab3" data-bs-toggle="tab">Recent</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#tab4" data-bs-toggle="tab">Absents</a>
        </li>
      </ul>
      <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="tab1">
        <table class="table table-striped table-borderless align-middle text-center">
    <thead>
      <tr>
        <th>Employee ID</th>
        <th>Name</th>
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
      <td><?php echo $list['employee_id']; ?> </td>
      <td><?php echo $list['Name']; ?> </td>
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
        </div>
        <div class="tab-pane fade" id="tab2">
        <table class="table table-striped table-borderless align-middle text-center mb-2">
    <thead>
      <tr>
        <th>Employee ID</th>
        <th>Name</th>
        <th>Remarks</th>
        <th>Date</th>
        <th>Overtime</th>
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
      <td><?php echo $row['employee_id']; ?> </td>
      <td><?php echo $row['Name']; ?> </td>
      <td><?php echo $row['remarks']; ?> </td>
      <td><?php echo $row['date']; ?> </td>
      <td><?php echo $row['over_time']; ?> </td>
      <td>
      <td>
      <form method="post" action="../Functions/overtime-accept.php">
          <input type="hidden" name="acceptid" id="acceptid" value=<?php echo $row['id']; ?>>
          <input type="submit" name="acceptbtn" id="acceptbtn" class="btn btn-sm btn-primary" value="Accept">
      </form>
      <form method="post" action="../Functions/overtime-delete.php">
          <input type="hidden" name="deleteid" id="deleteid" value=<?php echo $row['id']; ?>>
          <input type="submit" name="deletebtn" id="deletebtn" class="btn btn-sm btn-danger"  value="Delete">
      </form>
      </td>
    </tr>
    <?php
      }
?>
    </tbody>
  </table>
        </div>
        <div class="tab-pane fade" id="tab3">
          <h3>Recent logins</h3>
        </div>
        <div class="tab-pane fade" id="tab4">
          <h3>Absent</h3>
        </div>
      </div>
      <div class="mt-4">
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true"
                >Previous</a
              >
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
</ul>

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
   },4000);
  }else if(successValue === "delete"){
    Swal.fire({
		icon:'error',
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
   },4000);
  }
</script>