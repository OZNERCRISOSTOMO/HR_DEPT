<?php
//Including Database configuration file.
require '../Classes/admin.php';
require '../Classes/database.php';

$database = new Database();
$admin = new Admin($database);

$id = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../Images/Logo 1.svg">
    <title>Confirmation Account</title>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body style="background-color: #f2f2f2; font-family: Bahnschrift;">

<div class="container d-flex flex-column justify-content-center align-items-center vh-100">


<div class="container col-7 shadow  bg-white px-3 py-4 rounded">
    <h3 class="text-center p-2">Confirm Account</h3>

    <div>
        <?php 
            if (isset($id)) {
                $employeeDetails = $admin->getEmployees($id);
                // var_dump($employeeDetails);
            }
        ?>

        <div class="row">
            <div class="col-4">
        <div class="d-flex flex-column justify-content-center align-items-center "> 
             <img class="img-fluid rounded-circle mx-auto"  style="object-fit: cover;border-radius: 50%;height: 150px; width: 150px;"  src="../Uploads/<?php echo $employee["picture_path"] ?>">
             <p class="mt-2"><?php echo $employeeDetails["department"]?></p>
            </div> 
        </div>
       

        <div class="col-8">
        <h4 class="text-center pt-2"><?php echo $employeeDetails["first_name"] .' '. $employeeDetails["last_name"] ?></h4>
        <h6 class="text-center text-muted mb-2"><?php echo $employeeDetails["department_position"]?></h6>
        <hr>
        <div class="row">
            <div class="col">

        <p><i class="fa-solid fa-envelope mx-2"></i><?php echo $employeeDetails["email"]?></p>
        </div>
        <div>
        <p><i class="fa-solid fa-phone mx-2"></i><?php echo $employeeDetails["contact"]?></p>
        
        </div>
        </div>
            <div class="text-center">
        <a class="btn btn-secondary col-5" href="admin-forgotPassword.php">Not you?</a>
        <a class="btn btn-primary col-5"href="admin-newPassword.php?id=<?php echo $id?>">Continue</a>
        </div>
    </div>
        </div>
        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>