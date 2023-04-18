<?php
    
    $timezone = 'Asia/Manila';
	date_default_timezone_set($timezone);

    $dbServername = "sql985.main-hosting.eu";
    $dbUsername = "u839345553_sbit3g";
    $dbPassword = "sbit3gQCU";

    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');
    $date = new DateTime();
    if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}


  

?>
<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>Employee Attendance</title>
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
	  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
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
		<form action="../Functions/employee-attendance-revise.php" method="POST">
			<div class="form-group has-feedback mb-3">
					<input type="text" class="form-control input-lg shadow-none" id="employee" name="employee" autofocus >
					<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
			</div>
		</form>
		<form action="../Functions/employee-attendance-manual.php" method="POST">
			<div class="row">
				<div class="col-xs-4 d-grid">
					<button type="submit" name="signin" id="signin" class="btn btn-primary">
					<i class="fa-solid fa-right-to-bracket me-2"></i>
						Enter using username
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	window.addEventListener("pageshow", function(event) {
                var input = document.getElementById("employee");
                input.value = "";
         });
</script>
</body>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const successValue = urlParams.get('value');
    console.log(successValue);

if(successValue === "employeeNotfound"){
	Swal.fire({
		icon:'error',
		title:'User Not Found',
		toast:true,
		position:'top-end',
		showConfirmButton: false,
  		timer: 3000,
  		timerProgressBar: true,
		didOpen: (toast) => {
    	toast.addEventListener('mouseenter', Swal.stopTimer)
    	toast.addEventListener('mouseleave', Swal.resumeTimer)
  		}
	})
	setTimeout(function(){
    window.history.back();
   },4000);
}else if(successValue === "Timein"){
	const picture = urlParams.get('picture');
	const id = urlParams.get('ID');
	const name = urlParams.get('name');
	const post = urlParams.get('post');
	const timein = urlParams.get('Timein');
	const status = urlParams.get('status');
	const dept =urlParams.get('dep');
	
	Swal.fire({
		html:'<div><img src="../Uploads/'+picture+'" style="position:absolute;top:25px;left:50px;height:90px;width:90px;" class="img-fluid m-0 rounded-circle">'+
		'<p>Name: '+name+'</p>'+
		'<p>Department: '+dept+'</p>'+
		'<p>Position: '+post+'</p></div>',
		footer:'<h1 class="bi bi-check-circle-fill text-success" style="position:absolute;top:175px;left:70px;"></h1>'+
				'Time In Recorded<br>'+timein+'<br>'+status,
		showConfirmButton: false,
  		timer: 3000,
  		timerProgressBar: true,
  		didOpen: (toast) => {
    	toast.addEventListener('mouseenter', Swal.stopTimer)
    	toast.addEventListener('mouseleave', Swal.resumeTimer)
  		}
	})
	setTimeout(function(){
    window.history.back();
   },4000);
}else if(successValue === "Timeout"){
	const picture = urlParams.get('picture');
	const id = urlParams.get('ID');
	const name = urlParams.get('name');
	const post = urlParams.get('post');
	const timeout = urlParams.get('Timeout');
	const dept =urlParams.get('dep');
	
	Swal.fire({
		html:'<div><img src="../Uploads/'+picture+'" style="position:absolute;top:25px;left:50px;height:90px;width:90px;" class="img-fluid m-0 rounded-circle">'+
		'<p>Name: '+name+'</p>'+
		'<p>Department: '+dept+'</p>'+
		'<p>Position: '+post+'</p></div>',
		footer:'<h1 class="bi bi-check-circle-fill text-success" style="position:absolute;top:175px;left:70px;"></h1>'+
				'Time Out Recorded<br>'+timeout,
		showConfirmButton: false,
  		timer: 3000,
  		timerProgressBar: true,
  		didOpen: (toast) => {
    	toast.addEventListener('mouseenter', Swal.stopTimer)
    	toast.addEventListener('mouseleave', Swal.resumeTimer)
  		}
	})
	setTimeout(function(){
    window.history.back();

	window.onload = function() {
      document.getElementById('employee').value = '';
    };
   },4000);
}

</script>

<!--Keme->
<div class="login-box">
  	<div class="login-logo">
  		<p id="date"></p>
      <p id="time" class="bold"></p>
  	</div>
  
  	<div class="login-box-body">
    	<h4 class="login-box-msg">Enter Employee ID</h4>

    	<form action="../Functions/employee-attendance.php" method="POST">
          <div class="form-group">
            <select class="form-control" name="status">
              <option value="in">Time In</option>
              <option value="out">Time Out</option>
            </select>
          </div>
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control input-lg" id="employee" name="employee" autofocus required>
        		<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
      		</div>
      		<div class="row">
    			<div class="col-xs-4">
          	<input type="submit" name="signin" id="signin" value="Sign in">
        	</div>
      		</div>
    	</form>
</div>

	-->
<!-- <script>
	window.addEventListener("pageshow", function(event) {
                var input = document.getElementById("employee");
                input.value = "";
         });
</script>
</body> -->
</html>