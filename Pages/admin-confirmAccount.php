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
    <title>Document</title>
</head>
<body>
    <h1>Confirm account</h1>

    <div>
        <?php 
            if (isset($id)) {
                $employeeDetails = $admin->getEmployees($id);
                // var_dump($employeeDetails);
            }
        ?>
        <img class="" src="../Uploads/<?php echo $employee["picture_path"] ?>"  alt="">  <img class="rounded-circle mx-auto" src="../Uploads/<?php echo $employee["picture_path"] ?>">  
        <p><?php echo $employeeDetails["first_name"] .' '. $employeeDetails["last_name"] ?></p>
        <p><?php echo $employeeDetails["email"]?></p>
        <p><?php echo $employeeDetails["contact"]?></p>
        <p><?php echo $employeeDetails["department"]?></p>
        <p><?php echo $employeeDetails["department_position"]?></p>

        <a href="admin-forgotPassword.php">Not you?</a>
        <a href="admin-newPassword.php?id=<?php echo $id?>">Continue</a>
    </div>
</body>
</html>