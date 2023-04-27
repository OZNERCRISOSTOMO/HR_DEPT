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
    <Title> Employee List </Title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="../Images/Logo 1.svg">

  <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    .small-text {
  font-size: 10px;
}

.email-wrapper {
  display: inline-flex; /* display the icon and email address inline */

}
.card:hover{

  cursor: pointer;
}

.dropdown-menu li {
position: relative;
}
.dropdown-menu .dropdown-submenu {
display: none;
position: absolute;
left: 100%;
top: -7px;
}
.dropdown-menu .dropdown-submenu-left {
right: 100%;
left: auto;
}
.dropdown-menu > li:hover > .dropdown-submenu {
display: block;
}

   
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
      
    <!-----End----->
    
    <!-----Filter and Search Employee ----->
    <div class="container mt-3">
        <div class="row">
        <div class="col-sm pt-2">
            <h5 style="font-weight:bolder;">Employee List</h5>
        </div>
                <div class="col-md row ms-2">
                    <div class="col-sm rounded dropdown text-center ">
                        <button class="btn bg-white dropdown-toggle fw-bolder container-fluid" type="button" data-bs-toggle="dropdown" id="dropdown"><i class="fa-solid fa-filter px-1"></i><b>Sort By</b></button>
                        <ul class="dropdown-menu container-fluid">
                            <li><a class="dropdown-item" href="#">By Name</a></li>
                            
                            <li>
                            <a class="dropdown-item" href="#">By Department &raquo; </a>
                            <ul class="dropdown-menu dropdown-submenu">
                              <li>
                                <a class="dropdown-item" href="#">Human Resource</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#">Sales</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#">Warehouse</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#">Purchaser</a>
                              </li>
                            </ul>
                          </li>


                            <li><a class="dropdown-item" href="#">By Position</a></li>
                        </ul>
                    </div>
                    <div class="col-sm input-group">
                        <span class="input-group-text bg-white border border-end-0 border-0">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" class="form-control border-0 border shadow-none border-start-0" id="search" autocomplete="off">
                    </div>
                </div>
        </div>
    </div>
    <!-----End----->
 
    <!-----Employee List----->
    <div class="container-fluid ms-3 p-3 mt-3 employeeList-container align-content-center m-auto d-block ">
    <div class="row employee-list-wrapper">

      <?php 
        $employees = $admin->getEmployees();
  
        foreach($employees as $employee){                 
      ?>
    <div class="card bg-white rounded ms-2 my-2 pt-3 employee-container" style="width: 18rem;" data-bs-toggle="modal"
                         id="view" data-bs-target="#viewmodal" data-employee-id="<?php echo $employee["id"]?>">
                        <img class="rounded-circle mx-auto" src="../Uploads/<?php echo $employee["picture_path"] ?>" style="object-fit: cover;border-radius: 50%;height: 140px; width: 140px;" alt="Employee Pic">    
                        <div class="card-body ps-1">
                            <h6 class="card-title text-center col-11 m-auto" name="EmployeeName"><?php echo $employee["first_name"] . " " .$employee["last_name"];  ?></h6>
                            <p class="card-text text-center" style="opacity: 0.7;"><?php echo ucfirst($employee["department_position"]) ?></p>
                            
                            <div id="inCard"  style=" background-color: #f2f2f2;"; class="col-12 rounded m-auto align-content-center ms-2 ">
                            <table class="table table-borderless p-0 m-0 pb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th style="font-size: 14px;">Department:</th>
                                        <th style="font-size: 14px;">Date Hired: </th>
                                       
                                    </tr>
                                    

                                </thead> 
                               
                                <tbody>
                                <tr >
                                        <td class="ps-4" name="Department" style="font-size: 13.5px;"><?php echo ucfirst($employee["department"]) ?></td>
                                        <td class="ps-3" name="DateHired" style="font-size: 13.5px;"><?php echo  $admin->formatDate($employee["date_hired"] )?></td>
                                    </tr>   
                                </tbody>

                               
                            </table>
                            
                                <div class="col-12 mt-2">

                                <div class="d-flex ms-3">
                                <i class="fa-solid fa-star text-warning pe-2"></i> <p class="text d-flex flex-column col-10"  style="font-size: 13px;" name="Email">₱ <?php echo number_format($employee["rate_per_hour"] )?>/hr</p>
                                </div>

                                <div class="d-flex ms-3">
                                <i class="fa-solid fa-envelope text-primary text pe-2"></i> <p class="text d-flex flex-column col-10"  style="font-size: 13px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" name="Email"><?php echo $employee["email"] ?></p>
                                </div>

                            <div class="d-flex ms-3">
                            <i class="fa-solid fa-phone text-success pe-2"></i> <p class="text d-flex flex-column col-10"  style="font-size: 13px;" name="Email"><?php echo $employee["contact"] ?></p>
                            </div>
                        
                             </div>
                           
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
            <button type="button" class="text-danger border-0 bg-transparent" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editmodal">Edit</button>
        </div>
        </div>
    </div>
    </div>
    <!-----End----->

<!-- Modal for Edit -->
<div class="modal fade" id="editmodal">
<div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header" id="editmodal">
        <h5 class="modal-title">Edit Employee Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
      <div class="d-flex flex-row">
      <div class="flex-fill p-2">
        <div class="d-flex justify-content-center mb-2">
        <img class="rounded-circle mx-auto d-block" src="../Images/1x1 photo.png" height="150" width="150" alt="Employee Pic" />
        </div>
        <div class="d-flex justify-content-center">
        <div class="btn btn-primary btn-rounded btn-sm p-0 m-0">
            <label class="form-label text-white m-1" for="profile">Tap to Change Profile</label>
            <input type="file" class="form-control d-none" id="profile" />
        </div>
      </div>
              <input type="text"  class="form-control fs-2 fw-bold mt-2 text-center border-0 p-0 m-0" name="EmployeeFName" contenteditable="true" value="John Renzo"> </input>
              <input type="text"  class="form-control fs-2 fw-bold mt-2  text mt-2 text-center border-0 p-0 m-0" name="EmployeeLName" contenteditable="true" value="Crisostomo"></input>
              <input  type="text" class="form-control border-0 text-center" contenteditable="true" value="Project Manager"></input>

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
                <td> <input type="text" class="form-control form-control-sm border-0"  value="0001-AAA"></td>
                <td> <input type="text" class="form-control form-control-sm border-0" value="10/02/2023"></td>
                <td> <input type="text" class="form-control form-control-sm border-0" value="johnrenzocrisos@gmail.com"></td>

                </tr>
                <tr>
                  <th><p class="text" style="opacity: 0.5;">Contact Number </p></th>
                  <th><p class="text" style="opacity: 0.5;">Birthdate </p></th>
                </tr>
                <tr>
                  <td> <input type="text" class="form-control border-0" value="+639123456789"></td>
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
                  <td> <input type="text" class="form-control border-0" value="0000-0000000-0"></p></td>
                  <td> <input type="text" class="form-control border-0" value="000-000-000-0000"></td>
                  <td> <input type="text" class="form-control border-0" value="0000-0000-0000"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
            </div>
            </div>

      <!--Modal Body End-->

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="text-danger border-0 bg-transparent" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success btn-sm" id="editBtn">Save Changes</button>
      </div>

      </div> 
    </div>
  </div>
</div>

    <!-----End----->

    
    </div>
    </div>

<script src="../assets/js/employee-list-script.js"></script>
<script>
  // SWEET ALERT CONFIRMATION FOR LOGOUT
logoutBtn.addEventListener("click", function (e) {
  e.preventDefault();

  Swal.fire({
    title: "Are you sure?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Log me out",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      // e.target.href
      // console.log(e.target.closest(".logout").href)
      window.location.href = `${e.target.closest(".logout").href}`;
    }
  });
});
</script>
</body>
</html>