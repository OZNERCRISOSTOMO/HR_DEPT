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

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HR DEPARTMENT</title>

    <link rel="import" href="../Modals/M-Employee.php">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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

    <!-- ====== ICONS ========= -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- ==================== -->


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
                    <!---------------------------->
                      
        
                    <!------------ Modal Buttons ------------ -->

                            <div class="container py-4">
                                <div class="row">
                                    <div class="col">
                                <button type="button" class="btn  ps-0 btn-light shadow btn-md p-2 w-100 text-secondary" style="max-width: 200px; max-height: 300px;" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="MEmployees()">
                                <span class="fs-5 p-3 text-black">3</span> Employee
                                <span class="p-2"><i class=" text-primary fa-solid fa-circle-info fs-5 p-0" ></i></span>
                                </button>
                            </div>

                            <div class="col">
                                    <button type="button" class=" btn ps-0 btn-light shadow p-2 w-100 text-secondary" style="max-width: 200px; max-height: 200px;" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="Presents()">
                                    <span class="fs-5 p-3 text-black">13</span>Presents 
                                    <span class="p-2"><i class=" text-success fa-solid fa-circle-info fs-5 p-0" ></i></span>
                                    </button>
                            </div>

                            <div class="col">
                                    <button type="button" class="btn  ps-0 btn-light shadow p-2 w-100 text-secondary" style="max-width: 200px; max-height: 200px;"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <span class="fs-5 p-3 text-black">3</span> Warnings 
                                    <span class="p-2"><i class=" text-warning fa-solid fa-circle-info fs-5 p-0" ></i></span>
                                    </button>
                            </div>
                        
                            <div class="col">
                                    <button type="button" class="btn ps-0  btn-light shadow p-2 w-100 text-secondary" style="max-width: 200px; max-height: 200px;"   data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <span class="fs-5 p-3 text-black">3</span>  Pending
                                    <span class="p-2"><i class=" text-danger fa-solid fa-circle-info fs-5 p-0" ></i></span>
                                    </button>
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
                                                <ul class="dropdown-menu">
                                                    <div class="btn-group dropend">
                                                         <li>
                                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Dropend
  </button>
                                                    </li>
  
  <ul class="dropdown-menu">
    <li>test</li>
    <!-- Dropdown menu links -->
  </ul>
</div>
                                                   
                                                    <li><a class="dropdown-item" href="#">By Name</a></li>
                                                    <li><a class="dropdown-item" href="#">By Department</a></li>
                                                    <li><a class="dropdown-item" href="#">By Position</a></li>
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
                        <div class="container-fluid mb-2 ">
                        <div class="row employee-list-wrapper">
                        <?php
                    $employees = $admin->getEmployees();

                    
                    foreach($employees as $employee){
                         ?>
                    <div class="card mt-2 me-2" style="width: 16rem;">
                       <div class="card-body">
                            <?php
                          echo '<img src="../Uploads/' . $employee['picture_path'] . '" alt="avatar" style="object-fit: cover;border-radius: 50%;height: 150px; width: 150px;" class="mb-2 mx-auto d-block">';
                          echo '<h5 class="card-title text-center">'. $employee["first_name"]." " . $employee["last_name"] . '  </h5>';           
                          echo '<p class="">'. $employee["email"]. '  </p>';            
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
        
    
<script src="../Modals/M-Employee.js"></script>
<script src="../Modals/M-Presents.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
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
  title: 'Email sent successfully'
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
    });


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <!-- JS FROM ASSETS -->
    <script src="../assets/js/dashboard-script.js"></script>
  </body>
</html>