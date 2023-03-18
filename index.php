
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
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>HR MANAGEMENT SYSTEM</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script src="https://kit.fontawesome.com/53a2b7f096.js" crossorigin="anonymous"></script>
</head>
<body>


<div class="container-fluid">

  <div class="row">
    <div class="col-sm-6 ">
	<nav class="navbar bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand color-black" href="#">
      <img src="./images/Google-Admin-900x0.png" alt="Admin" width="70" height="50">
	  ADMIN
    </a>
  </div>
</nav>

<div class="container m-auto ">
<h4 class="text-center my-3">Start your day with hello Kitty</h4>
<img src="./images/pngtree-cartoon-company-employee-who-is-working-in-the-office-image_1377082-removebg-preview.png" class="img-fluid mx-auto d-block">
</div>


	</div>

    <div class="col-sm-6 d-flex justify-content-md-center align-items-center vh-100">

	<div class="container col-9 shadow-lg p-4"> 
	<div class="login-form ">
    <form action="Functions/admin-login.php" method="POST">
        <h4 class="text-center">Company Name</h4>   


        <div class="form-group py-2">
			<label for="exampleInputEmail1" class="form-label">Email</label>

			<div class="input-group">
			<div class="input-group-text bg-transparent border-right-0"><i class="fa-solid fa-user"></i></div>
        	<input type="text" class="form-control  border-left-0" name="email" placeholder="Email" required="required">
		</div>
		</div>
        </div>

		<div class="form-group py-1">
		<label for="examplePassword" class="form-label">Password</label>

		<div class="input-group">
			<div class="input-group-text bg-transparent border-right-0"><i class="fa-solid fa-lock"></i></div>
            <input type="password" class="form-control border-left-0" name="password" placeholder="Password" required="required">
		
		</div>
		</div>        

        <div class="form-group py-2">
            <button type="submit" class="btn btn-primary btn-md btn-block">Log in</button>
	</div>
        </form>
		</div>
	</div>
  </div>


       
            <?php
                if (isset($_GET["error"])) {

                    if ($_GET["error"] == "errorPassword") {
                        echo '<p class=""> Wrong password!</p>';
                    } else if ($_GET["error"] == "errorEmail") {
                        echo '<p class=""> Email does not exist!!</p>';
                    }else if ($_GET["error"] == "emptyInput") {
                        echo '<p class=""> Empty Input</p>';
                    }
                }
             
            ?> 
</body>
</html>