
<?php
// start session
session_start();


if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
   header("Location: Pages/dashboard.php");
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="./Images/Logo 1.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HR MANAGEMENT SYSTEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/53a2b7f096.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/index-style.css">

</head>
<body style="background-color: #f2f2f2; font-family: Bahnschrift;">

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 ">
            <nav class="navbar bg-body-tertiary">
                <div class="container">
                    <a class="navbar-brand color-black" href="#">
                    <img src="./Images/Logo 1.svg" alt="Admin" width="70" height="50">
                    ADMIN
                    </a>
                </div>
            </nav>

            <div class="container m-auto ">
                <h4 class="text-center my-3">Start your day with Coffee</h4>
                <img src="Images/login-illustration.png" class="mx-auto d-block" height="400">
            </div>
        </div>

        <div class="col-sm-6 d-flex justify-content-md-center align-items-center vh-100">
            
	        <div class="container col-9 shadow-lg p-4 login-container"> 
	            <div class="login-form ">
                    <form action="Functions/admin-login.php" method="POST">
                    <h4 class="text-center">Company Name</h4>   
                    <?php
                            if (isset($_GET["error"])) {
                                echo '<div class="container rounded shadow text-center p-3 text-danger" style="background-color: #ff9694;">';
                                if ($_GET["error"] == "errorPassword") {
                                    echo '<h5 class=""> Wrong password!</h5>';
                                } else if ($_GET["error"] == "errorEmail") {
                                    echo '<p class=""> Email does not exist!!</p>';
                                }else if ($_GET["error"] == "emptyInput") {
                                    echo '<p class=""> Empty Input</p>';
                                }else if ($_GET["error"] == "absent") {
                                    echo '<p class="">Time in First!</p>';
                                }else if ($_GET["error"] == "notDept") {
                                    echo '<p class="">Not Department!</p>';
                                }else if ($_GET["error"] == "notAdmin") {
                                    echo '<p class="">Not Admin!</p>';
                                }
                                echo '</div>';
                            }            
                        ?> 
                    <div class="form-group py-2" >
			            <label for="exampleInputEmail1" class="form-label fw-bolder">Username</label>
                            <div class="input-group">
                                <div class="input-group-text bg-white border border-end-0 border-0"><i class="fa-solid fa-user"></i></div>
                                    <input type="text" class="form-control border-0 border shadow-none border-start-0" name="email" placeholder="Email" autocomplete="off" required="required">
                                </div>
                            </div>
                    </div>

		    <div class="form-group py-1">
		        <label for="examplePassword" class="form-label fw-bolder">Password</label>

		        <div class="input-group">
			        <div class="input-group-text bg-white border border-end-0 border-0"><i class="fa-solid fa-lock"></i></div>
                        <input type="password" class="form-control border-0 border shadow-none border-start-0" name="password" placeholder="Password" required="required">
		
		            </div>
		        </div>        

                    <div class="form-group py-2 d-grid">
                    <button type="submit" name="submit" class="btn btn-primary btn-md btn-block login-btn">
                        <i class="fa-solid fa-right-to-bracket me-2"></i>
                        Log in
                    </button>
                    </div>
                </form>
                <a href="Pages/admin-forgotPassword.php">Forgot password?</a>
		    </div>
            
            <!-- Loading spinner container -->
            <div class="container col-9 shadow-lg p-5 loading-container hide-container">
                <div class="loading">
                    <svg viewBox="25 25 50 50">
                        <circle r="20" cy="50" cx="50"></circle>
                    </svg>
                </div>

                <p>Logging in, please be patient </p>
            </div>
        
	</div>
  </div>

<script>
    const loginBtn = document.querySelector(".login-btn")
    const loginContainer = document.querySelector(".login-container")
    const loadingContainer = document.querySelector(".loading-container")

    loginBtn.addEventListener("click",function(){
        loginContainer.classList.add("hide-container")
        loadingContainer.classList.remove("hide-container")
    })

</script>
       
            
</body>
</html>