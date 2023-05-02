
<title>Bootstrap demo</title>
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
  <h5 class="text-black mt-4">Holidays</h5>
  <div class="d-grid gap-2 mb-2 ">

  <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#Holiday">
  <i class="fa-solid fa-plus"></i>&nbsp;Add Holiday
</button>
<?php include("../Modals/M-Holiday.php")?>  
  </div>







<div class="overflow-auto w-100" style="height: 15rem;">


<!--buong card to-->
  <div class="card-container mb-2">
    <div class="card" style="width: 100%; height:5rem;">
      <div class="card-body">
        <h3 class="card-text" style="font-size:16px; font-weight:bold;">Feb 14. 2023</h3>
        <div class="row">
          <div class="col-6">
            <h3 class="card-title"style="font-size:13px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis">Valentines Day</h3>
          </div>
          <div class="col-1 ms-2">
            <button class="btn btn-transparent btn-sm border-0 border-none" type="submit">
              <i class="fa-solid text-primary fa-pen-to-square"></i>
            </button>
          </div>
          <div class="col-1">
            <button class="btn btn-transparent btn-sm border-0 border-none" type="submit">
              <i class="fa-solid text-danger fa-square-minus"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--buong card to-->




</div>
   
    

    </div>

    <div class="container1">
    <form   action="../Functions/admin-sendEmail.php" method="POST" enctype="multipart/form-data">
      <div class="search-select-box mb-2 mt-3  ">                     
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
            <div class=" input-group input-group-sm">  
                        <input type="text" class="shadow-none form-control" placeholder="Subject" name="subject" autocomplete="off" required>
                    </div>
                    <div class="mb-2 input-group input-group-sm">
                        <textarea class="shadow-none form-control mt-2" name="message"  rows="4" placeholder="Message" autocomplete="off" required style="resize:none;"></textarea>
                    </div>
                    <div class="mb-2 input-group input-group-sm">
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
