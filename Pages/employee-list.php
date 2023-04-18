<?php
// start session
session_start();

if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    

    $database = new Database();
    $admin = new Admin($database);

    
} else {
    header("Location: ../index.php");
}
?>
<html>
<head>
    <Title> EMPLOYEE LIST </Title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/308043b825.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
      <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/index-style.css">
<style>
    container-fluid{
        overflow: hidden;
    }
    #inCard {
        background-color: #f2f2f2;
    };
</style>
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
    <!------End----->

    <!-----Title----->
        <div class="container d-flex ms-5 mt-2">
            <h5 style="font-weight:bolder;">Employee List</h5>
        </div>
    <!-----End----->
    
    <!-----Filter and Search Employee ----->
    <div class="container ">
        <div class="row float-end">
                <div class="col-md row ms-2">
                    <div class="col-sm rounded dropdown text-center bg-white">
                        <button class="btn dropdown-toggle fw-bolder container-fluid" type="button" data-bs-toggle="dropdown" id="dropdown">By Department</button>
                        <ul class="dropdown-menu container-fluid">
                            <li class="dropdown-item">Human Resources</li>
                            <li class="dropdown-item">Sales</li>
                            <li class="dropdown-item">Warehouse</li>
                            <li class="dropdown-item">Purchasing</li>
                        </ul>
                    </div>
                    <div class="col-sm input-group">
                        <span class="input-group-text bg-white border border-end-0 border-0">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" class="form-control border-0 border shadow-none border-start-0" id="Search" autocomplete="off">
                    </div>
                </div>
        </div>
    </div>
    <!-----End----->

    <!-----Employee List----->
    <div class="container mt-5 employeeList-container">
    <div class="row-cols-4">

      <?php 
        $employees = $admin->getEmployees();
  
        foreach($employees as $employee){                 
      ?>
    <div class="card bg-white rounded mx-2 py-3 employee-container" data-bs-toggle="modal"
     id="view" data-bs-target="#viewmodal" data-employee-id="<?php echo $employee["id"]?>">
                        <img class="rounded-circle mx-auto" src="../Uploads/<?php echo $employee["picture_path"] ?>" style="object-fit: cover;border-radius: 50%;height: 150px; width: 150px;" alt="Employee Pic">    
                        <div class="card-body ps-1">
                            <h4 class="card-title text-center" name="EmployeeName"><?php echo $employee["first_name"] . " " .$employee["last_name"];  ?></h4>
                            <p class="card-text text-center" style="opacity: 0.5;"><?php echo ucfirst($employee["position"]) ?></p>
                            <div id="inCard" class="rounded ms-3">
                            <table class="table table-borderless mt-2">
                                <thead>
                                    <tr class="text-center">
                                        <th>Department</th>
                                        <th>Date Hired</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    <tr class="text-center">
                                        <td name="Department"><?php echo ucfirst($employee["department"]) ?></td>
                                        <td name="DateHired"><?php echo  $admin->formatDate($employee["date_hired"] )?></td>
                                    </tr>                     
                                </tbody>
                            </table>
                            
                            <p class="card-text ms-3" name="Email"><i class="fa-solid fa-envelope text-primary"></i><?php echo $employee["email"] ?></p>
                            <p class="card-text ms-3" name="ContactNum"><i class="fa-solid fa-phone text-success"></i> <?php echo $employee["contact"] ?></p>
                        </div>
                        </div>
                    </div>
          <?php 
              } 
          ?>          
        </div>
    </div>
    <!-----End----->

        <!-- Modal for View -->
        <div class="modal fade" id="viewmodal">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">Employee Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->

        <div class="modal-body ">  
  <div class="d-flex flex-row employee-modal-body">
    <!-- <div class="flex-fill p-2">
      <img class="rounded-circle mx-auto d-block" src="../Images/1x1 photo.png" height="150" width="150" alt="Employee Pic">
      <h2 class="text" name="EmployeeName">Renzo Caloocan</h2>
      <p class="text text-center">Project Manager</p>
      <div class="rounded ms-3"></div>
    </div>
    <div class="flex-fill p-2">
      <div class="form-floating">
        <h5 style="font-family: Bahnschrift;">Personal Information</h5>
        <table class="table table-borderless mt-2">
          <thead>
            <tr>
              <th><p class="text" style="opacity: 0.5;">Employee ID </p></th>
              <th><p class="text" style="opacity: 0.5;">Date Hired </p></th>
              <th><p class="text" style="opacity: 0.5;">Email </p></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><p class="text" style=";">0001-AAA</p></td>
              <td>10/02/2023</td>
              <td>johnrenzocrisos@gmail.com</td>
            </tr>
            <tr>
              <th><p class="text" style="opacity: 0.5;">Contact Number </p></th>
              <th><p class="text" style="opacity: 0.5;">Birthdate </p></th>
            </tr>
            <tr>
              <td>+639123456789</td>
              <td>21/02/2002</td>
            </tr>
          </tbody>
        </table>
        <h5 style="font-family: Bahnschrift;">Benefits</h5>
        <table class="table table-borderless mt-2">
          <thead>
            <tr>
              <th><p class="text" style="opacity: 0.5;">SSS </p></th>
              <th><p class="text" style="opacity: 0.5;">TIN </p></th>
              <th><p class="text" style="opacity: 0.5;">PhilHealth </p></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><p class="text" style=";">0000-0000000-0</p></td>
              <td>000-000-000-0000</td>
              <td>0000-0000-0000</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> -->
  </div>

             <!-- Loading spinner container -->
            <div class=" loading-container hide-container">
                <div class="loading">
                    <svg viewBox="25 25 50 50">
                        <circle r="20" cy="50" cx="50"></circle>
                    </svg>
                </div>

            </div>
</div>
               

        <!--Modal Body End-->

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <!-----End----->

    <!-- Modal for Edit -->
        <div class="modal fade" id="editmodal">
        <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">Employee Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="form-floating">
            <input type="text" class="form-control" name="EmployeeName" id="floatingName" placeholder="Employee Name"> </textarea>
            <label for="floatingName" style="font-family: Bahnschrift;">Employee Name</label>
            </div>

        <div class="form-floating mt-3">
            <textarea class="form-control" name="EmployeePos" id="floatingPosition" placeholder="Employee Position"> </textarea>
            <label for="floatingPosition" style="font-family: Bahnschrift;">Employee Position</label>
            </div>

        <div class="dropdown mt-3">
            <select name="Category" id="category">
            <option value="Category">Department</option>
            <option value="Sales">Sales</option>
            <option value="HR">HR</option>
            <option value="Secret">Secret</option>
            </select>
        </div>
        </div>
        <!--Modal Body End-->

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" name="add-details">Submit</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    </div>
    <!-----End----->

    
    </div>
    </div>

<script src="../assets/js/employee-list-script.js"></script>
</body>
</html>