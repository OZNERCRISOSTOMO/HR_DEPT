<?php 
$dbServername = "sql985.main-hosting.eu";
$dbUsername = "u839345553_sbit3g";
$dbPassword = "sbit3gQCU";

$conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');
$date = new DateTime();

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['signin'])){
    // getting data from the FORM
    $username = $_POST['login_id'];
    $password = $_POST['login_password'];

    // Query the database
    $sql = "SELECT * FROM employee_login WHERE login_id='$username'";
    $query = $conn->query($sql);

    // Check if the username and password are valid
    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        $_SESSION['login_id'] = $row['login_id'];

        //getting the password and compare to hash
        $input_password = $row['login_password']; //getting the password from database and save as variable
        $hashed_input_password = password_hash($password, PASSWORD_DEFAULT); //compare and convert password

        // Check if the hashed password matches the stored password
        if (password_verify($password, $input_password)) {
            // Close database connection
            mysqli_close($conn);

            // Redirect to Attendance Page
            header("Location: ../Pages/admin-attendanceList.php");
            exit();
        } else {
            // Display an error message in a pop-up window
            echo "<script>alert('Invalid Login ID or Password!');</script>";
        }

    } else {
        // Display an error message in a pop-up window
        // echo "<script>alert('Invalid Login ID or Password!');</script>";
    }

    // Close database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>Employee Attendance Manual</title>
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  	<!-- Font Awesome -->
  	<script src="https://kit.fontawesome.com/53a2b7f096.js" crossorigin="anonymous"></script>
  	<!-- Theme style -->
  	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition login-page" style="background-color: #f2f2f2; font-family: Bahnschrift;">

<div class="container-fluid">
	<div class="row">
		<nav class="navbar bg-body-tertiary">
			<div class="container-fluid ms-1">
				<div class="row d-flex justify-content-end align-middle">
					<a class="navbar-brand me-auto d-flex" href="#"> 
						<img src="../images/Google-Admin-900x0.png" alt="Admin" width="70" height="50" class="ms-2">
						<h4 class="my-auto">Attendance</h4>
					</a>
				</div>

				<div class="d-flex justify-content-start">
					<a class="navbar-brand ms-auto" href="#">
						<h5 style="font-weight:bolder;" class="float-end my-auto me-3"> 
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
					</a>
				</div>
			</div>
		</nav>
	</div>

		
	
	<div class="col-sm-5 m-auto my-5 shadow-lg p-4 rounded align-items-center">
		<img src="../Images/Attendance-logo.png" class="mx-auto d-block mb-3" height="150" width="150">
		<form action="" method="POST">
            <div class="form-group mb-3" >
                <label for="exampleInputEmail1" class="form-label fw-bolder">Email</label>
                    <div class="input-group">
                        <div class="input-group-text bg-transparent border-right-0"><i class="fa-solid fa-user"></i></div>
                            <input type="text" class="form-control shadow-none border-left-0" name="login_id" id="login_id" placeholder="Email" required="required">
                        </div>
                    </div>
                
                <div class="form-group mb-3">
		            <label for="examplePassword" class="form-label fw-bolder">Password</label>
		                <div class="input-group">
			                <div class="input-group-text bg-transparent border-right-0"><i class="fa-solid fa-lock"></i></div>
                            <input type="password" class="form-control shadow-none border-left-0" name="login_password" id="login_password" placeholder="Password" required="required">
		                </div>
		        </div> 

                <div class="row">
				    <div class="col-xs-4 d-grid">
					    <button type="submit" name="signin" id="signin" class="btn btn-primary">
					        <i class="fa-solid fa-right-to-bracket me-2"></i>
						    Log in
					    </button>
				    </div>
			    </div>
            </div>
            
		    

			
		</form>
	</div>
</div>


</body>
</html>