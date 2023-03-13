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

    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

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
                    <a href="../admin/prlist.php">Payroll</a>
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
                <div class="count-container total-employees">
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

                <div class="count-container total-pending-employees">
                    <?php
                    $totalEmployee = $admin->getTotalPendingEmployees();
                         echo '<p class="">'. $totalEmployee. ' Pending  </p>';    
                    ?>
                </div>
            </div>
            <!-- =================================================-->

            <div class="main-content-container">

                <!-- ================ EMPLOYEE LIST ========================== -->
                <div class="employee-list ">
                    <div>
                        <h1>Employee List</h1>

                        <!-- DROPDOWN FILTER EMPLOYEE -->
                        <div>

                        </div>

                        <!-- SEARCH EMPLOYEE -->
                        <div>
                            <input type="text" id="search" placeholder="Search" name="search-employee" />
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
                          echo '<p class="">'. $employee["address"]. '  </p>';
                          echo '<p class="">'. $employee["gender"]. '  </p>';                
                          echo '<p class="">'. $employee["contact"]. '  </p>';            
                          echo '<p class=""> Date hired : '. $admin->formatDate($employee["date_applied"]) . '</p>';
                        ?>
                        </div>
                        <?php
                    }
                        ?>
                    </div>
                </div>

                <!--============== PENDING EMPLOYEE ======================= -->
                <div class="pending-employee-list hide-container">
                    <div>
                        <h1>Pending Employees</h1>
                    </div>

                    <div class="pending-employee-list-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Contact No</th>
                                    <th scope="col">Resume</th>
                                    <th scope="col">Date Applied</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $pendingEmployees = $admin->getPendingEmployees();
                                
                                    foreach($pendingEmployees as $employee){

                                    echo '<tr>';
                                        echo '<th scope="row">1 </th>';
                                        echo '<td>'. $employee["first_name"] ." ". $employee["last_name"] .'</td>';
                                        echo '<td>'. $employee["email"] .'</td>';
                                        echo '<td>'. $employee["gender"] .'</td>';
                                        echo '<td>'. $employee["contact"] .'</td>';
                                    ?>
                                        <td>
                                            <a href="../Uploads/<?php echo $employee['resume_path']?>" target="_thapa">
                                                <?php echo $employee['resume_name']?>
                                            </a>
                                        </td>
                                     <?php
                                         echo '<td>'. $admin->formatDate($employee["date_applied"]) .'</td>';
                                     ?>
                                        <td>
                                            <input type="hidden" name="doc_id" value="<?php echo $employee["id"] ?>">
                                            <button type="button" class="btn btn-outline-success acceptBtn"> Accept</button>
                                            <button type="button" class="btn btn-outline-danger declineBtn">Decline</button>
                                        </td>
                                     <?php
                                    echo "</tr>";

                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- ============================================== -->

            </div>
        </div>
        <!-- --------------------------- -->

        <!------------ SIDEBAR ---------- -->
        <div class="sidebar">

        </div>
        <!------------------------------- -->
    </main>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <script>
    const logoutBtn = document.querySelector('.logout');
    const totalEmployees = document.querySelector(".total-employees")
    const totalPendingEmployees = document.querySelector(".total-pending-employees")
   
    const listOfContainer = [".employee-list",".pending-employee-list"]
    let currentMainContent = listOfContainer[0];

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
                window.location.href = `${e.target.href}`

            }
        })

    })



   totalEmployees.addEventListener("click",function(){
       if(currentMainContent != listOfContainer[0]){
         //remove hide-container 
        document.querySelector(listOfContainer[0]).classList.remove("hide-container")

        //add hide-container to current
        document.querySelector(currentMainContent).classList.add("hide-container")

        //replace current
        currentMainContent = listOfContainer[0];
     }
   })

   totalPendingEmployees.addEventListener("click",function(e){
     if(currentMainContent != listOfContainer[1]){
         //remove hide-container 
        document.querySelector(listOfContainer[1]).classList.remove("hide-container")

        //add hide-container to current
        document.querySelector(currentMainContent).classList.add("hide-container")

        //replace current
        currentMainContent = listOfContainer[1];
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