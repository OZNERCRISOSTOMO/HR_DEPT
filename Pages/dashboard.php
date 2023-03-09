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
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="dashboard.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

        <!-- JQUERY -->      
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="../assets/css/dashboard-style.css">

        <!-- SWEET ALERT -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
    <body>

    <main class="dashboard">
        <!----------- SIDEBAR ---------- -->
        <div class="sidebar">

        <ul>
            <li>
                <a href="">Dashboard</a>
            </li>

            <li>
                <a href="">Employee</a>
            </li>

            <li>
                <a href="">Attendance</a>
            </li>

            <li>
                <a href="prlist.php">Payroll</a>
            </li>
        </ul>

            <div>
               ======== Sa baba to mga idol========
                <!-- DISPLAY ADMIN DATA  -->
                <?php
                $adminData = $admin->getAdmin();                          
                 echo '<p class="">'. ucfirst($adminData['first_name']) .' '. strtoupper($adminData['last_name'][0]). '</p>';                                   
                ?>
                            
                <!-- LOGOUT BUTTON -->
                <a href="../functions/admin-logout.php" class="logout">
                 Logout
                 </a>
                ===================================
            </div>
        </div>
        <!------------------------------ -->

        <!------------ MAIN ------------ -->
        <div class="main">
            
      
            <div class="count-wrapper">
                      <!-- TOTAL EMPLOYEES  -->
                <div class="count-container">
                    <?php
                    $totalEmployee = $admin->getTotalEmployees();
                         echo '<p class="">'. $totalEmployee. ' Employees </p>';    
                    ?>
                </div>

                 <!-- TOTAL PRESENT EMPLOYEES  -->
                <div class="count-container">
                    <?php
                    $totalEmployee = $admin->getTotalEmployees();
                         echo '<p class="">'. $totalEmployee. ' Employees </p>';    
                    ?>
                </div>

                <div class="count-container">
                    <?php
                    $totalEmployee = $admin->getTotalEmployees();
                         echo '<p class="">'. $totalEmployee. ' Employees </p>';    
                    ?>
                </div>

                <div class="count-container">
                    <?php
                    $totalEmployee = $admin->getTotalEmployees();
                         echo '<p class="">'. $totalEmployee. ' Employees </p>';    
                    ?>
                </div>

                <div class="count-container">
                    <?php
                    $totalEmployee = $admin->getTotalEmployees();
                         echo '<p class="">'. $totalEmployee. ' Employees </p>';    
                    ?>
                </div>
         
            </div>

            <div>
                <div>
                    <h1>Employee List</h1>

                    <!-- DROPDOWN FILTER EMPLOYEE -->
                    <div>

                    </div>

                    <!-- SEARCH EMPLOYEE -->
                    <div>
                        <input type="text" id="search" placeholder="Search" name="search-employee"/>
                    </div>
                </div>

                <div class="employee-list-wrapper">
                <?php
                    $employees = $admin->getEmployees();

                    foreach($employees as $employee){
                ?>
                    <div class="employee-list-container">
                        <?php
                          echo '<p class="">'. $employee["first_name"]." " . $employee["last_name"] . '  </p>';           
                          echo '<p class="">'. $employee["email"]. '  </p>'; 
                          echo '<p class="">'. $employee["department"]. '  </p>'; 
                          echo '<p class="">'. $employee["contact"]. '  </p>'; 
                          echo '<p class="">'. $employee["date_hired"]. '  </p>'; 
                        ?>
                    </div>
                <?php
                    }
                ?>
                </div>
            </div>



        
        </div>
        <!-- --------------------------- -->

        <!------------ SIDEBAR ---------- -->
        <div class="sidebar">
                    
        </div>
        <!------------------------------- -->
    </main>

      

  
                    
     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

        <script>
        const logoutBtn = document.querySelector('.logout');

        // SWEET ALERT CONFIRMATION FOR LOGOUT
         logoutBtn.addEventListener('click', function (e) {
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
                window.location.href = `${e.target.href}`

            }
        })
    
})

        // SEARCH EMPLOYEE
    $(document).ready(function() {
       $("#search").keyup(function(){
            var input = $(this).val();

           if (input == ""){
                 $.ajax({
                    url:"../Functions/admin-livesearch.php",
                    type: "POST",
                    data: {search:"all"},

                    success:function(data){
                        $(".employee-list-wrapper").html(data);
                    }
                })
            }else{
                
                   $.ajax({
                    url:"../Functions/admin-livesearch.php",
                    type: "POST",
                    data: {search:input},

                    success:function(data){
                        $(".employee-list-wrapper").html(data);
                    }
                })
            }
       })
    })
   
    </script>
    </body>
</html>

