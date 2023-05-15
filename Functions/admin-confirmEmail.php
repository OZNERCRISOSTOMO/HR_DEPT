<?php
//Including Database configuration file.
require '../Classes/admin.php';
require '../Classes/database.php';

$database = new Database();
$admin = new Admin($database);

if (isset($_POST['submit'])) {
   $employeeEmail = trim($_POST["email"]);
   echo $employeeEmail;

   $employeeDetails = $admin->findEmployeeByEmail($employeeEmail);
   $employeeId = $employeeDetails[0]["id"];
   
   if(!$employeeDetails){
      header("Location: ../Pages/admin-forgotPassword.php?error=invalidEmail");
      exit();
   }

   header("Location: ../Pages/admin-confirmAccount.php?id=$employeeId");
}