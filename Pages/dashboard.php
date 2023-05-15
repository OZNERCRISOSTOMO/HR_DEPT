<?php
// start session
session_start();
$timezone = 'Asia/Manila';
date_default_timezone_set($timezone);
$lognow = date('H:i:s');

if (isset($_SESSION['admin_id'])) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $admin = new Admin($database);

    //get admin data 
    $adminData = $admin->btnPic($_SESSION['admin_id']);
    
    if($lognow < "15:30:00"){
        $employee = $admin->selectEmployeeSched('1');
    }else if($lognow > "15:30:00"){
        $employee = $admin->selectEmployeeSched('2');
    }

    $countPresents = 0;
   foreach ($employee as $sched) {
    foreach ($sched as $key => $value) {

        //check in attendance if exist 
        $valueEmployee = $admin->checkAttendance($value);

        if(!$valueEmployee){
            $countPresents++;
            
        }
    }
}

$employee1 = $admin->getEmployee();
$countWarnings1 = 0;
foreach($employee1 as $list){
  $employeeID = $list['id'];

  $countWarnings = $admin->getTotalWarnings($employeeID);

  if($countWarnings >= 3){
    $countWarnings1++;
  }

}
$conn = mysqli_connect("sql985.main-hosting.eu", "u839345553_sbit3g", "sbit3gQCU", "u839345553_SBIT3G");

$employeeQuery = "SELECT * FROM employees";
$employeeResult = $conn->query($employeeQuery);
$countWarnings = 0;

// Step 3: Loop through each employee id and get the count of absent days
while ($idRow = $employeeResult->fetch_assoc()) {
// Get the employee id
$employee_id = $idRow["id"];

// Execute the SQL query to count absent days for this employee
$countQuery = "SELECT COUNT(status) as countss FROM attendance WHERE employee_id = '$employee_id' AND status = 'ABSENT'";
$countResult = $conn->query($countQuery);

// Get the count of absent days
$countRow = $countResult->fetch_assoc();
$counttt = $countRow["countss"];

// Display the count of absent days
if($counttt >= 3){
  $countWarnings++;
}

}

// simula dito
  $dateString = date('Y-m-d');

  $dayh = "SELECT * FROM holiday WHERE holiday_date = '$dateString'";
  $dayhh = $conn->query($dayh);
  $dayhhh = $dayhh->fetch_assoc();

    $month = date('m', strtotime($dateString));

    $backup_file = "u839345553_SBIT3G_".$month.".sql";

    $filePath = '../backups/'.$backup_file.'';
    $currentMonth = date('n');

    if(file_exists($filePath) || $currentMonth % 4 != 0){
      $backup = 'none';
    }
    if($currentMonth % 4 == 0) {
      $backup = 'block';
    }

    $dayOfMonth = date('d');

    if ($dayOfMonth == 15 || $dayOfMonth == date('t')) {
      $payday = 'block';
  } else {
     $payday = 'none';
  }

  if($dayhh->num_rows > 0){
    $hday = $dayhhh['holiday_name'];
    $hdayd = 'block';
  }else{
    $hdayd = 'none';
  }

  $countNotif = 0;

  if($backup === 'block'){
    $countNotif++;
  }

  if($payday === 'block'){
    $countNotif++;
  }
  
  if($hdayd === 'block'){
    $countNotif++;
  }
  //end
}
else {
    header("Location: ../index.php");
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HR Department</title>

    <link rel="import" href="../Modals/M-Employee.php">

    <link rel="icon" type="image/x-icon" href="../Images/Logo 1.svg">

    <!-- SWEET ALERT -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- BOOTSTRAP 5 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Select2 CSS --> 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
    <!-- jQuery --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <!-- Select2 JS --> 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- ====== ICONS ========= -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- ==================== -->

    <style>
        .swal2-title {
        font-size: 15px;
      }
        .swal2-icon {
        font-size: 10px;
      }
      .swal2-shown {
        overflow: visible !important;
      }
      

      .modal-pending{
            z-index: 9999;
        }


        .d-none{
            display: none;
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
  <body style=" background-color: #eee; font-family: Bahnschrift;"> 

      <div class="container-fluid">
      <div class="row">
       <!------------ SIDEBAR ------------ -->
            <div class="col-2 p-0">
                <?php include("../Components/Sidebar-Left.php")?>
            </div>
        <!---------------------------->

        <!------------ MAIN ------------ -->
          <div class="col-xl-8 h-100  overflow-auto" >
          <div class="container-fluid p-0 m-0">
    <div class="row flex-nowrap">
        <div class="main col-lg-12" >
    
                <!--Time and Date-->
                <div class="container-fluid d-flex ">

             

                  <div class="m-auto justify-content-center align-items-center mt-4">
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

                          <div class=" justify-content-end mt-3">
                        <div class="dropdown ">
                        <button class="btn btn-transparent " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fs-5 fa-solid fa-bell"></i>  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                          <?php echo $countNotif; ?>
                          <span class="visually-hidden">unread messages</span> </button>

                        <ul class="dropdown-menu w-auto" style="max-width: 30rem;">
                          <li class="dropdown-item" id="payday" style="display:<?php echo $payday; ?>;">
                            <div class="list-group-item text-wrap px-2" style="width: 20rem;">
                            <div class="container-fluid d-flex">
                              <div class="row d-flex">
                                <div class="col-2 p-0 m-0 d-flex justify-content-center align-items-center">  <i class="fa-solid fa-money-check" style="font-size: 40px;"></i>
                              </div>
                              
                                <div class="col-10">
                                  <p class=" p-0 m-0">Payday Alert</p>
                                  <small class="text-muted">It's payday for your employees! It's time to set their salaries."</small>
                                  </div>
                          </div>
                          </div>
                          
                          </li>
                            <hr>
                          <li class="dropdown-item"  id="backup" style="display:<?php echo $backup; ?>;">
                          
                          
                          <div class="list-group-item text-wrap px-2" style="width: 20rem;">
                            <div class="container-fluid d-flex">
                              <div class="row d-flex">
                                <div class="col-2 p-0 m-0 d-flex justify-content-center align-items-center">  <i class="fa-solid fa-database" style="font-size: 40px;"></i>
                              </div>
                              
                                <div class="col-10">
                                  <p class=" p-0 m-0"> You Need To Back Up your File</p>
                                  <small class="text-muted">Don't risk losing important data. Take a few minutes to back up your files now."</small>
                                  </div>
                          </div>
                          </div>
                          
                          
                          
                        </li>

                        <hr>
                          <li class="dropdown-item"  id="holiday" style="display:<?php echo $hdayd; ?>;">
                          <div class="list-group-item text-wrap px-2" style="width: 20rem;">
                            <div class="container-fluid d-flex">
                              <div class="row d-flex">
                                <div class="col-2 p-0 m-0 d-flex justify-content-center align-items-center">  <i class="fa-regular fa-calendar" style="font-size: 40px;"></i>
                              </div>
                              
                                <div class="col-10">
                                  <p class=" p-0 m-0"> Holiday announcement</p>
                                  <small class="text-muted">It's <?php echo $hday; ?> with holiday pays, Enjoy your day!."</small>
                                  </div>
                          </div>
                          </div>
                          
                        
                        </li>
                          
                        </ul>
                      </div>
                      </div>

                        
                    </div>
                    <!---------------------------->
                      
        
                    <!------------ Modal Buttons ------------ -->

                            <div class="container py-4">
                                <div class="row">
                                    <div class="col" >
                                <button type="button" class="btn  ps-0 btn-light shadow btn-md p-2 w-100 vh-100 text-secondary" style="max-width: 200px; max-height: 50px;"  onclick="goToPage()">
                                <span class="ps-2 text-black" style="font-size: 18px;"><?php echo $admin->getTotalEmployees(); ?> </span> Employee
                                <span ><i class=" text-primary fa-solid fa-circle-info p-0"  style="font-size: 18px;"></i></span>
                                </button>
                            </div>

                            <div class="col">
                                    <button type="button" class=" btn ps-0 btn-light shadow btn-md p-2 w-100 vh-100 text-secondary" style="max-width: 200px; max-height:  50px;" data-bs-toggle="modal" data-bs-target="#presentModal">
                                    <span class="p-2 text-black" style="font-size: 18px;">
                                    <?php 
                                    if($lognow < "15:30:00"){
                                        echo $admin->getTotalPresent('1');
                                    }else if($lognow > "15:30:00"){
                                        echo $admin->getTotalPresent('2');
                                    }
                                    ?> 
                                    </span>Presents 
                                    <span ><i class=" text-success fa-solid fa-circle-info p-0" style="font-size: 18px;" ></i></span>
                                    </button>
                                    <?php include("../Modals/M-Presents.php")?>  
                            </div>

                            <div class="col">
                                    <button type="button" class=" btn ps-0 btn-light shadow btn-md p-2 w-100 vh-100 text-secondary" style="max-width: 200px;max-height:  50px;" data-bs-toggle="modal" data-bs-target="#absentModal">
                                    <span class="p-2 text-black"  style="font-size: 18px;"><?php echo "$countPresents" ?> </span>Absents 
                                    <span ><i class=" text-danger fa-solid fa-circle-info p-0" style="font-size: 18px;" ></i></span>
                                    </button>
                                    <?php include("../Modals/M-Absent.php")?>  
                            </div>

                            <div class="col">
                                    <button type="button" class="btn  ps-0 btn-light shadow btn-md p-2 w-100 vh-100 text-secondary" style="max-width: 200px; max-height:  50px;"  data-bs-toggle="modal" data-bs-target="#WarningModal">
                                    <span class="p-2 text-black" style="font-size: 18px;"><?php echo "$countWarnings" ?></span> Warnings 
                                    <span ><i class=" text-warning fa-solid fa-circle-info  p-0"  style="font-size: 18px;"></i></span>
                                    </button>
                                    <?php include("../Modals/M-Warning.php")?>  
                            </div>
                        
                            <div class="col">
                
                                     <button type="button" class="btn ps-0  btn-light shadow btn-md p-2 w-100  vh-100  text-secondary" style="max-width: 200px; max-height:  50px;"   data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                    <span class="p-2 text-black" style="font-size: 18px;"><?php echo $admin->getTotalPendingEmployees(); ?></span>  Pending
                                    <span ><i class=" text-secondary fa-solid fa-circle-info p-0" style="font-size: 18px;"></i></span>
                                    </button>

                                    <?php include("../Modals/M-Pending.php")?>   
                                   

                                 
                                </div>


                             </div>
                                </div>
                        <!---------------------------->


                        <!------------ Employee Title ------------ -->

                            <div class="container">

                                    <div class="container py-3">
                                        <div class="row">
                                            <div class="col-6 ">
                                                <h4>  Employee List</h4>
                                            </div>

                                            <div class="col-2">
                                             <!-- DROPDOWN FILTER EMPLOYEE -->
                                                    
                                             <div class="dropdown ">
  <button class="btn bg-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-solid fa-filter px-1"></i> <b>Sort By</b>
  </button>

  <ul class="dropdown-menu sort-dropdown" id="sort-dropdown">
    <li>
      <a class="dropdown-item" href="#" id="byName">By Name</a>
    </li>

    <li>
      <a class="dropdown-item" href="#">By Department &raquo; </a>

      <ul class="dropdown-menu dropdown-submenu department-dropdown">

        <li>      
            <a class="dropdown-item" href="#" id="human-resource" >Human Resource</a>                                   
        </li>

        <li>
          <a class="dropdown-item" href="#" id="sales">Sales</a>
        </li>
        <li>
          <a class="dropdown-item" href="#" id="warehouse" >Warehouse</a>
        </li>
        <li>
          <a class="dropdown-item" href="#" id="purchaser" >Purchaser</a>
        </li>
      </ul>
    </li>

    <li>
      <a class="dropdown-item" href="#" id="byPosition">By Position</a>
    </li>
   </ul>

</div>
                                                
                                            </div>

                                            <div class="col-4">
                                                <!-- SEARCH BAR -->
                                                    <div class="input-group W-100">
                                                    <span class="input-group-text bg-white border border-end-0 border-0">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                    </span>
                                                    <input type="text" name="search-employee" class="form-control border-0 border shadow-none border-start-0" id="search" autocomplete="off" style="max-width: 200px;">
                                            
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        <!-------------------------------->

                        
                        <!------------ Employee List ------------ -->
                        <div class="container-fluid mb-2  ">

                        <div class="row employee-list-wrapper">
                        <?php
                    $employees = $admin->getEmployees();

                    
                    foreach($employees as $employee){
                         ?>
                     <div class="card bg-white rounded ms-2 my-2 pt-3 employee-container" style="width: 16rem;" 
                         id="view" data-bs-target="#viewmodal" data-employee-id="<?php echo $employee["id"]?>">
                        <img class="rounded-circle mx-auto" src="../Uploads/<?php echo $employee["picture_path"] ?>" style="object-fit: cover;border-radius: 50%;height: 140px; width: 140px;" alt="">    
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
                                <tr class="text-center ">
                                        <td name="Department" style="font-size: 13.5px;"><?php echo ucfirst($employee["department"]) ?></td>
                                        <td name="DateHired" style="font-size: 13.5px;"><?php echo  $admin->formatDate($employee["date_hired"] )?></td>
                                    </tr>   
                                </tbody>

                               
                            </table>
                            
                                <div class="col-12 mt-2">

                                <div class="d-flex ms-3">
                                <i class="fa-solid fa-star text-warning pe-2"></i><p class="text d-flex flex-column col-10"  style="font-size: 13px;" name="Email">₱ <?php echo number_format($employee["rate_per_hour"] )?>/hr</p>
                                </div>

                                <div class="d-flex ms-3">
                                <i class="fa-solid fa-envelope text-primary text pe-2"></i><p class="text d-flex flex-column col-10 textToCopy"  style="font-size: 13px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" name="Email" id="textToCopy"><?php echo $employee["email"] ?></p>
                                </div>

                            <div class="d-flex ms-3">
                            <i class="fa-solid fa-phone text-success pe-2"></i><p class="text d-flex flex-column col-10"  style="font-size: 13px;" name="Email"><?php echo $employee["contact"] ?></p>
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
                         <!-------------------------------->
            
                  </div>
                  </div>
                  </div>
        
            </div>
         <!---------------------------->



        <!------------ SIDEBAR ------------ -->
          <div class="col-2 ">
          <?php include("../Components/Sidebar-Right.php")?>    
          </div>
        <!---------------------------->

</div>
</div>

 <script>

 // Get the dropdown menu element
//  var dropdownMenu = document.getElementById('#sort-dropdown');

// // Get the dropdown items and sort them alphabetically
// var items = dropdownMenu.getElementsByTagName('a');
// var itemsArr = [];
// for (var i = 0; i < items.length; i++) {
//   itemsArr.push(items[i].innerHTML);
// }
// itemsArr.sort();

// // Reorder the dropdown items based on the sorted array
// for (var i = 0; i < itemsArr.length; i++) {
//   for (var j = 0; j < items.length; j++) {
//     if (items[j].innerHTML === itemsArr[i]) {
//       dropdownMenu.appendChild(items[j].parentNode);
//       break;
//     }
//   }
// }
// Get current date
// let currentDate = new Date();

// // Check if today is the 15th day of the month
// if (currentDate.getDate() === 15) {
//   // Display SweetAlert notification for 15th day of the month
//   document.getElementById("payday").style.display = "block";
// }

// // Check if today is the last day of the month
// let lastDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
// if (currentDate.getDate() === lastDayOfMonth) {
//   // Display SweetAlert notification for last day of the month
//   document.getElementById("payday").style.display = "block";
// }



  const textElements = document.querySelectorAll(".textToCopy");

  textElements.forEach(function (text) {
    let clickCount = 0;

   
    text.addEventListener("click", function () {
      clickCount++;
  
      if (clickCount === 1) {
        // Start a timer to wait for double click
        setTimeout(function () {
          textCopyFunction(text);
          clickCount = 0;
        }, 300);
      } else if (clickCount === 2) {
        redirectToSendEmail(text);
        clickCount = 0;
      }
    });

    text.addEventListener("dblclick", function () {
      redirectToSendEmail(text);
      clickCount = 0;

    });
  });



function textCopyFunction(text) {
  const range = document.createRange();
  range.selectNode(text);
  window.getSelection().removeAllRanges();
  window.getSelection().addRange(range);
  document.execCommand("copy");
  window.getSelection().removeAllRanges();

  Swal.fire({
    position: "top-end",
    icon: "success",
    title: "Text Copied!",
    showConfirmButton: false,
    timer: 1000,
    height: 100,
    width: 300,
  });
}

function redirectToSendEmail(text) {
  const selectedEmail = text.textContent;
  const dropdown = document.getElementById("select-employee");
  const options = dropdown.options;

  // loop through email dropdown
  for (let i = 0; i < options.length; i++) {
    const option = options[i];
    const email = option.dataset.employeeEmail;

    if (email === selectedEmail) {
      option.selected = true;
      $(dropdown).trigger("change");
    }
  }
}


    </script>   
    
<!-- <script src="../Modals/M-Employee.js"></script>
<script src="../Modals/M-Presents.js"></script> -->
 <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>  -->
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> -->
 
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <!-- JS FROM ASSETS -->
    <script src="../assets/js/dashboard-script.js"></script>

    <script>

function goToPage() {
    window.location.href = "../Pages/employee-list.php";
}
    </script>
  </body>
</html>


