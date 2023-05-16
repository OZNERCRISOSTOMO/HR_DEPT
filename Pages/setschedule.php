
<?php
// establish a connection to the MySQL database
$conn = mysqli_connect("sql985.main-hosting.eu", "u839345553_sbit3g", "sbit3gQCU", "u839345553_SBIT3G");

// check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Set Schedule</title>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body style="background-color: #f2f2f2; font-family: Bahnschrift;">
  


  <?php $id = $_GET['id']; 


   $sql = "SELECT employees.*, employee_details.* FROM employees JOIN employee_details ON employees.id = employee_details.employee_id WHERE employees.id = $id";
   $result = mysqli_query($conn, $sql);

   while ($row = mysqli_fetch_assoc($result)){


    if ($row["schedule_id"] == '1') {
      $schedule = "7:00AM - 3:00PM";
  } 

  else if ($row["schedule_id"] == '2') {
      $schedule = "3:00PM - 11:00PM";  
  } 
  ?>
<div class="container d-flex flex-column justify-content-center align-items-center vh-100">


<div class="container col-7 shadow  bg-white px-2 py-4 rounded">

<div class="row">

<div class="col-5 text-center">


<i class="fa-solid fa-circle-user pb-3" style="font-size: 120px;"></i>
<span class="d-flex justify-content-center">
<h5 class="px-2"><?php echo $row["first_name"]?></h5>
<h5><?php echo $row["last_name"]?></h5>

   </span>

   <p class="text-muted"><?php echo $row["department_position"]?></p>
   </div>


   <div class="col-7">
<form method="POST" action="../Functions/setSchedule.php">

    <h4 class="text-center">Set Schedule</h4>
    <p class="text-center">Assigned Schedule: <?php echo $schedule?> </p>
    <hr>
    
          <div class="px-3">
                              Schedule : 
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" value="1" id="1" name="schedule" required>
                                    <label class="form-check-label" for="1">7:00 AM - 3:00 PM</label>
                                </div>
            
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" value="2" id="2" name="schedule" required>
                                    <label class="form-check-label" for="2">3:00 PM - 11:00 PM</label>
                                </div>
                         
</div>
      <div class="d-flex px-2 py-2">

      <a type="submit" href="../Pages/ListEmployee_Dept.php" class="btn btn-secondary w-100 pe-2">Cancel</a>
        <input type="hidden" name="id" value=<?php echo $id ?>>

       
        <button type="submit" name="submit1" class="btn btn-primary w-100">Set Schedule</button>
      </div>

</form>
   </div>
   </div>
</div>
   </div>
<?php }?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>

<!-- Modal Schedule -->
