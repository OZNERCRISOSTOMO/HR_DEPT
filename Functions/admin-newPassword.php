<?php
//Including Database configuration file.
require '../Classes/admin.php';
require '../Classes/database.php';

$database = new Database();
$admin = new Admin($database);

if (isset($_POST['submit-password'])) {
    $password = trim($_POST["password"]);
    $newPassword = trim($_POST["new-password"]);
    $employeeId = $_POST["employee-id"];
    

    //check if password same 
    if($password !== $newPassword){
        header("Location: ../Pages/admin-newPassword.php?id=$employeeId&status=passNotSame");
    }

    // Hash the password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    //update password 
    $updateStatus = $admin->updateAdminPassword($hashedPassword,$employeeId);

    
    if($updateStatus){
        //get employee email 
        $employeeEmail = $admin->getEmployeeEmail($employeeId);
        echo $employeeEmail["email"];
        //send email
        $database->sendEmail($employeeEmail["email"],"New Password",$newPassword);
    }


    //redirect to password change success
    header("Location: ../Pages/admin-passwordChangeSuccess.php?id=$employeeId");
}


