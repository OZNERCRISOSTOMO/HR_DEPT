
<title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid align-content-end  " >
  <div class="row flex-nowrap">
    <div class="col-md-4  col-xl-2 px-sm-2 px-0 bg-white   vh-100 position-fixed shadow order-last">
      <div class="d-flex me-2 flex-column align-items-center px-1  text-white min-vh-100 position-fixed">
                
            

      
      <div class="w-100">
        <h5 class="text-black mt-4">
            Holidays
        </h5>
        <div class="d-grid gap-2 mb-2 ">
        <button  class=" btn btn-success btn-sm" name="submit" id="send-email"><i class="fa-solid fa-plus"></i>&nbsp Add Holiday</button>
         </div>  

            <div class=" ">
            <div class="card" style="max-width: 300px; max-height: 100px;">
            <div class="card-body">
            <p class="card-text"><small>Feb 14. 2023</small></p>
            <div class="row ">
            <div class="col-6">
            <p class="card-title" style="margin-top: -20px;"><small>Valentines Day</small></p>
            </div>
            <div class="col-2 ">
            <button class="btn btn-transparent btn-sm" type="submit"><i class="fa-solid text-primary fa-pen-to-square"></i></button>
            </div>
            <div class="col-2">
            <button class="btn btn-transparent btn-sm" type="submit"><i class="fa-solid text-danger fa-square-minus"></i></button>
            </div>

            </div>
            </div>
            </div>

    </div>
      



   
    <form  action="../Functions/admin-sendEmail.php" method="POST" enctype="multipart/form-data">
      <div class="search-select-box mb-2 mt-3  ">                     
                        <!-- Dropdown --> 
                        <select id='select-employee' name="employee-id" class="form-control">
                            <option value="0">Select employee</option>
                         <?php
                             $employees = $admin->getEmployees();

                             foreach($employees as $employee){
                                echo "<option value='".$employee['id'] ."'>". $employee['first_name']." ".$employee['last_name']  ."</option> ";
                             }
                         ?>
                        </select>

                    </div>
            <div class="mb-2 input-group input-group-sm">  
                        <input type="text" class="form-control" placeholder="Subject" name="subject" required>
                    </div>
                    <div class="mb-2 input-group input-group-sm">
                        <textarea class="form-control" name="message"  rows="4" placeholder="Message" required></textarea>
                    </div>
                    <div class="mb-2 input-group input-group-sm">
                     <input class="col-2 form-control" type="file" id="attachment" name="attachment" accept="application/pdf">
                            </div>
                    <input type="hidden" id="" name="">
                    <div class="d-grid gap-2 ">
                    <button  class=" btn btn-primary btn-sm" name="submit" id="send-email"><i class="fa-solid fa-paper-plane me-2"></i> Send</button>
                            </div>  
            </form>
            </div>                    

          
            </div>
            
        

       
    </div>
    
</div>
