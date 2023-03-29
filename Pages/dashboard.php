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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>HR Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard-style.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<!-- or -->
<link rel="stylesheet"
href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
   
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>


    

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Select2 CSS --> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 

<!-- jQuery --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        

</head>

<body style="background-color: #f2f2f2; font-family: Bahnschrift;">
<!----------- SIDEBAR ---------- -->
<div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="text-decoration-none nav_logo">  <span class="nav_logo-name">COMPANY</span> </a>
                <div class="nav_list">
                 <a href="#" class="text-decoration-none nav_link active"><i class='bx bx-grid-alt nav_icon'></i>  <span class="nav_name">Dashboard</span> </a>
                 <a href="#" class="text-decoration-none nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Employes</span> </a> 
                <a href="#" class="text-decoration-none nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Attendance</span> </a>
                <a href="../admin/prlist.php" class="text-decoration-none nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Payroll</span> </a>
                <a href="../Payslip JSPDF/index.php" class="text-decoration-none nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Payslip</span> </a>
             </div>
            </div>
             <a href="../functions/admin-logout.php" class="text-decoration-none nav_link logout">
                 <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span>
             </a>
        </nav>
    </div>
        <!---------------------------->
        <div class="container-fluid">
    <div class="row flex-nowrap">

        <!------------ MAIN ------------ -->
        <div class="main col-lg-10" >

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
                    <div class="row">

                <!-- TOTAL EMPLOYEES  -->
                <div class="col">
                <div class="count-container">
                <button class="count-container total-employees btn btn-outline-primary">
                    <?php
                    $totalEmployee = $admin->getTotalEmployees();
                         echo '<p class="">'. $totalEmployee. ' Employees </p>';    
                    ?>
                </button>
                </div>
                </div>

                <!-- TOTAL PRESENT EMPLOYEES  -->
                <div class="col">
                <div class="count-container">
                    <button class="btn btn-outline-primary">
                         <?php
                    // $totalEmployee = $admin->getTotalEmployees();
                    //      echo '<p class="">'. $totalEmployee. ' Employees </p>';   
                    echo "1 Employees"; 
                    ?>
                    </button>
                   
                </div>
                </div>

                <div class="col">
                <div class="count-container">
                    <button class="btn btn-outline-primary">
                         <?php
                    // $totalEmployee = $admin->getTotalEmployees();
                    //      echo '<p class="">'. $totalEmployee. ' Employees </p>';   
                    echo "1 Employees"; 
                    ?>
                    </button>
                </div>
                </div>

                <div class="col">
                <div class="count-container">
                    <button class="btn btn-outline-primary">
                         <?php
                    // $totalEmployee = $admin->getTotalEmployees();
                    //      echo '<p class="">'. $totalEmployee. ' Employees </p>';   
                    echo "1 Employees"; 
                    ?>
                    </button>
                </div>
                </div>

                <!-- TOTAL PENDING EMPLOYEES  -->
                <div class="col">
                <div class="count-container total-pending-employees">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <?php
                            $totalEmployee = $admin->getTotalPendingEmployees();
                             echo '<p class="">'. $totalEmployee. ' Pending  Employees</p>'; 
                         
                        ?>
                    </button>

                    <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                         <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                              <?php
                                //  $database->fetchFileFromHostinger(); c
                                include "pending-employee.php";

                               ?>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                <!-- =========================== -->
                </div>
            </div>
            <!-- =================================================-->

            <div class="main-content-container">

                <!-- ================ EMPLOYEE LIST ========================== -->
                <div class="employee-list ">
                    <div class="row">
                    <div class="col-5">
                    <h5>Employee List</h5>
                        </div>
                        

                        <!-- DROPDOWN FILTER EMPLOYEE -->
                        <div class="col-3">
                    
                        <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown button
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                        </div>

                        </div>

                        <!-- SEARCH EMPLOYEE -->
                        <div class="col-3">
                            <input type="text" id="search" placeholder="Search" name="search-employee" />
                        </div>
                    </div>

                    <div class="container">
                        <div class="row employee-list-wrapper">
                        <?php
                    $employees = $admin->getEmployees();

                    
                    foreach($employees as $employee){
                         ?>
                    <div class="card" style="width: 18rem;">
                       <div class="card-body">
                            <?php
                           echo '<img src="../Uploads/' . $employee['picture_path'] . '" alt="avatar" style="width: 150px;" class="img-fluid m-0 rounded-circle">';
                          echo '<h5 class="card-title text-center">'. $employee["first_name"]." " . $employee["last_name"] . '  </h5>';           
                          echo '<p class="">'. $employee["email"]. '  </p>';
                          echo '<p class="">'. $employee["address"]. '  </p>';
                          echo '<p class="">'. $employee["gender"]. '  </p>';                
                          echo '<p class="">'. $employee["contact"]. '  </p>';            
                          echo '<p class=""> Date hired : '. $admin->formatDate($employee["date_applied"]) . '</p>';
                        ?>
                        </div>
                    </div>
                        <?php
                    }
                        ?>
                    </div>
                </div>
                </div>
            </div>
        
                </div>
        <!-- --------------------------- -->


        <div class="col bg-default">
        <!------------ SIDEBAR ---------- -->
        

            <!--==== SEND EMPLOYEE EMAIL -->
            <div class="sidebar pe-2">
                <form action="../Functions/admin-sendEmail.php" method="POST" enctype="multipart/form-data">
   
                   <div class="mb-2">
                   <div class="dropdown">      
                                   
                        <!-- Dropdown --> 
                        <select id='select-employee' name="employee-id">
                            <option value="0">Select employee</option>
                         <?php
                             $employees = $admin->getEmployees();

                             foreach($employees as $employee){
                                echo "<option value='".$employee['id'] ."'>". $employee['first_name']." ".$employee['last_name']  ."</option> ";
                             }
                         ?>
                        </select>
                        </div>
                       
                            </div>

                    <div class="mb-2">
                        <input type="text" class="form-control" placeholder="Subject" name="subject" required>
                    </div>

                    <div class="mb-2">

                        <textarea class="form-control" name="message"  rows="4" placeholder="message" required></textarea>
                    </div>

                    <div class="mb-2">
                     <input class="col-2 form-control" type="file" id="attachment" name="attachment" accept="application/pdf">
                            </div>

                    <input type="hidden" id="" name="">
                    <div class="d-grid gap-2 ">
                    <button  class=" btn btn-primary" name="submit" id="send-email">Send</button>
                            </div>  
                </form>
            </div>
       
                            </div>
        <!------------------------------- -->
                            </div>
                            </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>


    <script>
    const action = document.querySelector('.action');
    const logoutBtn = document.querySelector('.logout');
    const totalEmployees = document.querySelector(".total-employees")
    const totalPendingEmployees = document.querySelector(".total-pending-employees")
   
    const listOfContainer = [".employee-list",".pending-employee-list"]
    let currentMainContent = listOfContainer[0];



    $(document).ready(function(){
  
    // Initialize select2
    $("#select-employee").select2();
    
    $("#send-email").prop("disabled",true)

    // Read selected option
    $('#select-employee').on('change', function() {
        var selectedValue = $(this).val();
        console.log(selectedValue);
        if(selectedValue != '0'){
            $("#send-email").prop("disabled",false)
        }else{
            $("#send-email").prop("disabled",true)
        }
        
        });
    });
    
    //get url 
    const urlParams = new URLSearchParams(window.location.search);
    const successValue = urlParams.get('success');
    console.log(successValue);

    //SWEET ALERT EMAIL SENT
    if(successValue === "emailSent"){
        const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Signed in successfully'
})
    }
    

    // SWEET ALERT CONFIRMATION FOR LOGOUT
    logoutBtn.addEventListener('click', function(e) {
        e.preventDefault()

        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Log me out',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // e.target.href
                // console.log(e.target.closest(".logout").href)
                window.location.href = `${e.target.closest(".logout").href}`

            }
        })

    })

    //Accept pending employee
         //Accept button function 
        action.addEventListener('click', function(e) {
            if (e.target.classList.contains('acceptBtn')) {
                $('#acceptModal').modal('show');
                const targetParent = e.target.closest('td')
                
                const employeeId = targetParent.firstElementChild.value        
                const employeeEmail = targetParent.firstElementChild.nextElementSibling.value
                const employeeLastName = targetParent.firstElementChild.nextElementSibling.nextElementSibling.value
            
                document.querySelector('#employee_id_accept').value = employeeId;
                document.querySelector('#employee_email_accept').value = employeeEmail;
                document.querySelector('#employee_lastname_accept').value = employeeLastName;
            }

            if (e.target.classList.contains('declineBtn')) {
                $('#declineModal').modal('show');
                // const docId = e.target.closest('td').firstElementChild.value
                // document.querySelector('#ebooks_id_decline').value = docId;
            }
        })


    // SEARCH EMPLOYEE
    $(document).ready(function() {
        $("#search").keyup(function() {
            var input = $(this).val();

            if (input == "") {
                $.ajax({
                    url: "../Functions/admin-livesearch.php",
                    type: "POST",
                    data: {
                        search: "all"
                    },

                    success: function(data) {
                        $(".employee-list-wrapper").html(data);
                    }
                })
            } else {

                $.ajax({
                    url: "../Functions/admin-livesearch.php",
                    type: "POST",
                    data: {
                        search: input
                    },

                    success: function(data) {
                        $(".employee-list-wrapper").html(data);
                    }
                })
            }
        })
    })


    </script>
</body>
</html>