<html>
<title>Bootstrap demo</title>
<!-- SWEET ALERT -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"><style>

.container1 {
  height: 200px; /* Set a fixed height for the container */
  max-height:200px;
}

/* form {
  position: absolute;
  bottom: 15px;
  left: 0;
  width: 100%;
  max-width: 100%;
} */
    </style>
</head>
<body>
  
<div class="container-fluid align-content-end " >
  <div class="row flex-nowrap">
    <div class="col-md-4  col-xl-2 px-sm-2 px-0 bg-white   vh-100 position-fixed shadow order-last">
      <div class="d-flex me-2 flex-column align-items-center px-1  text-white min-vh-100 position-fixed">
                
  <div class="w-100">
 <h5 class="text-black mt-2">Holidays Pay</h5>
  <div class="d-grid gap-2">


  <form method="POST" action="../Functions/holiday-function.php">
  <div class="input-group input-group-sm mb-1">
  
  <input type="text" class="form-control" aria-label="Sizing example input" name="hname" aria-describedby="inputGroup-sizing-sm" placeholder="Holidays" required>
</div>
 
<div class="input-group input-group-sm mb-1">
 
  <input type="date" class="form-control" name="hdate" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
</div>
<div class="input-group input-group-sm mb-1 ">
 
<select class="form-select" aria-label="Default select example" name="hpercent" id="hpercent">
<option selected>Select department</option>
<option value="Regular Holiday">Regular Holiday</option>
<option value="Special Non-Working Holiday">Special Non-Working Holiday</option>         
</select>

</div>
 
  <button type="submit" name="hsubmit" class="btn btn-success btn-sm mb-2 w-100">Add Holiday</button>
</form>



  </div>






  


<div class="overflow-auto w-100" style="height: 10rem;">


<!--buong card to-->
<?php 
  $dbServername = "sql985.main-hosting.eu";
  $dbUsername = "u839345553_sbit3g";
  $dbPassword = "sbit3gQCU";

  $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$h_display = "SELECT * FROM holiday";
$h_query = $conn->query($h_display);

while($row = mysqli_fetch_assoc($h_query)){
?>


  <div class="card-container mb-2">
    <div class="card" style="width: 100%; height:5rem;">
      <div class="card-body">
        <h3 class="card-text" style="font-size:16px; font-weight:bold;"><?php echo $row['holiday_name'] ?></h3>
        <div class="row">
          <div class="col-7">
            <h3 class="card-title"style="font-size:13px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis"><?php echo $row['holiday_date'] ?></h3>
          </div>

          <div class="col-1">
            <button class="btn btn-transparent btn-sm border-0 border-none" type="submit">
            
            </button>
          
          </div>
          <div class="col-1 ">
              <form method="POST" action="../Functions/holiday-delete.php">
                <input type="hidden" name="a" value=<?php echo $row['id'];?>>
            <button class="btn btn-transparent btn-sm border-0 border-none" type="submit" name="delete_holiday">
             <i class="fa-solid text-danger fa-square-minus"></i>
            </button>
            </form>
           
          </div>


         
        </div>
      </div>
    </div>
  </div>
<?php } ?>
  
<!--buong card to-->




</div>
   
    

    </div>
    <hr class="p-0 m-0" style="width:100%; color:black;">

    <div class="container1"> 
      
    <form   action="../Functions/admin-sendEmail.php" method="POST" enctype="multipart/form-data">

<div class="row ">

  <div class="col-2">
<i class="fa-regular fa-envelope text-black fs-4 mt-2 mb-2 opacity-75"></i>
</div>
      <div class="col-10 search-select-box mt-2 mb-2">                     
                        <!-- Dropdown --> 
                        <select id='select-employee' name="employee-id" class="form-control">
                            <option value="0">Select employee</option>
                         <?php
                             $employees = $admin->getEmployees();

                             foreach($employees as $employee){
                                       echo "<option value='" . $employee['id'] . "' data-employee-email='" . $employee['email'] . "'>" . $employee['first_name'] . " " . $employee['last_name'] . "</option>";

                             }
                         ?>
                        </select>

                    </div>




                            </div>
            <div class=" input-group input-group-sm">  
                        <input type="text" class="shadow-none form-control" placeholder="Subject" name="subject" autocomplete="off" required>
                    </div>
                    <div class="mb-1 input-group input-group-sm">
                        <textarea class="shadow-none form-control mt-2" name="message"  rows="4" placeholder="Message" autocomplete="off" required style="resize:none;"></textarea>
                    </div>
                    <div class="mb-1 input-group input-group-sm">
                     <input class="shadow-none col-2 form-control" type="file" id="attachment" name="attachment" accept="application/pdf">
                            </div>
                    <input type="hidden" id="" name="">
                    <div class="d-grid gap-2 ">
                    <button  class="shadow-none btn btn-primary btn-sm" name="submit" id="send-email"><i class="fa-solid fa-paper-plane me-2"></i> Send</button>
                            </div>  
            </form>
            </div>     
            </div>                    

          
            </div>
            
        

       
    </div>
    
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>