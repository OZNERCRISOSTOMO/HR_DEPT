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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/53a2b7f096.js" crossorigin="anonymous"></script>
</head>

<body style="background-color: #f2f2f2; font-family: Bahnschrift;">
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

<div class="container">
  <h4 class="fw-bolder">Attendance</h4>
  <button class="btn border-0 border shadow-none border-start-0 mb-1">
    <h4><i class="fa-solid fa-clock-rotate-left"></i></h4>
  </button>
  <div class="col-sm input-group w-25 float-end">
      <span class="input-group-text bg-white border border-end-0 border-0">
        <i class="fa-solid fa-magnifying-glass"></i>
      </span>
      <input type="text" id="search" placeholder="Search" name="search-employee" />
      <input type="text" class="form-control border-0 border shadow-none border-start-0" id="Search" autocomplete="off">
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

</body>
</html>