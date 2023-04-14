<head>

<title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid align-content-end order-last ">
  <div class="row flex-nowrap">
    <div class="col-md-4  col-xl-2 px-sm-2 px-0 bg-white order-last vh-100 position-fixed shadow">
      <div class="d-flex me-2 flex-column align-items-center px-1  text-white min-vh-100 position-fixed">
                
            
      <form action="../Functions/admin-sendEmail.php" method="POST" enctype="multipart/form-data">
            <div class="dropdown mb-2 mt-2">
            <a class="btn btn-secondary btn-sm mdropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Select Employee
            </a>
            <ul class="dropdown-menu" id='select-employee' name="employee-id"> 
            <?php
            $employees = $admin->getEmployees();
            foreach($employees as $employee){
            echo "<li><a class='dropdown-item' value='".$employee['id'] ."'>". $employee['first_name']." ".$employee['last_name']  ."</a></li> ";
                }
            ?>
            </ul>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>