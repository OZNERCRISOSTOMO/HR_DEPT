<head>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

<link rel="stylesheet"
href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script> 

<style>

        .nav-item>a:hover {
            color: black;
        }
 
        .nav_links{
            color: gray;
        }
        .active{
            color:black;
            font-weight: bolder;
        }
    
    </style>
</head>
<!----------- SIDEBAR ---------- -->
<div class="container-fluid ">
    <div class="row flex-nowrap">
        <div class=" px-0 bg-white vh-100 position-fixed" style="max-width: 165px">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 position-fixed ">
                <a href="" class="d-flex align-items-center text-black pb-3 mb-md-0 me-md-auto  text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline mb-3 mt-2">Company</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start text-center" id="menu">
                    <li class="nav-item mb-5 ps-2 "> 
                    <a href="../Pages/dashboard.php" class="text-decoration-none nav_links px-0 align-middle "><i class='bx bx-grid-alt nav_icon'></i>  <span class="nav_name">Dashboard</span> </a>
                    </li>
                    <li class="nav-item mb-5 ps-2">
                    <a href="../Pages/employee-list.php" class="text-decoration-none nav_links px-0 align-middle "> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Employees</span> </a> 
                    </li>
                    <li class="nav-item mb-5 ps-2">
                    <a href="../Pages/admin-attendanceList.php" class="text-decoration-none nav_links px-0 align-middle "> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Attendance</span> </a>
                    </li>
                    <li class="nav-item mb-5 ps-2">
                    <a href="../admin/prlist.php" class="text-decoration-none nav_links px-0 align-middle "> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Payroll</span> </a>
                    </li>

                    
                </ul>
                <hr>
                <div class="nav-item pb-4 ps-2 ">
                <a href="../functions/admin-logout.php" class="text-decoration-none  nav_link logout px-0 align-middle text-black">
                 <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span>
             </a>
                </div>
            </div>
        </div>
       
    </div>
</div>

<script>
var currentUrl = window.location.href;
var navLinks = document.querySelectorAll('#menu a');
for (var i = 0; i < navLinks.length; i++) {
  if (navLinks[i].href === currentUrl) {
    navLinks[i].classList.add('active');
  }
}
    </script>

