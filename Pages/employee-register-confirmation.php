<?php

//if no success in url, redirect to employee-register
if(!isset($_GET["success"])){
    header("Location: employee-register.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Employee Register Confirmation</title>
    <script src="https://kit.fontawesome.com/53a2b7f096.js" crossorigin="anonymous"></script>

    <style>   body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh; /* make the body height the same as the viewport */
      background-color: #eee;
    }
    .card {
      max-width: 1000px;
    }</style>
</head>
<body style="background-color: #eee;">

        <div class="container d-flex justify-content-center align-items-center">




        <div class="card col-md-9 bg-white shadow-lg text-center m-auto">
            <div class="card-body mb-5">

        
            <i class="fa-regular fa-circle-check text-success mt-5" style="font-size:150px; text-shadow: 3px 3px lightgray; "></i>
            <h1>Thanks!</h1>
            
            <h5 class="mt-2 mb-5">Your application has been submitted, <br>we will notify you.</h5>

            <a class="bg-color-secondary mb-5"href="../Pages/employee-register.php" >Submit another response</a>

            </div>
            </div>

           
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>

