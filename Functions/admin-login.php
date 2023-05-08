<?php

if ($_POST['email'] !== '' && $_POST['password'] !== '') {

require '../Classes/admin.php';
require '../Classes/database.php';


// include '../includes/autoload-class.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $database = new Database();
    $admin = new Admin($database);


    $adminData = $admin->findByEmail($email);
    $adminID = $adminData['employee_id'];
    $adminAttendance = $admin->checkAttendance($adminID);
    //check if email exist 
    if(!$adminAttendance){
            header("Location:../index.php?error=absent");
        exit();
    }
    if(!$adminData){
          header("Location:../index.php?error=errorEmail");
        exit();
    }

    //check if password not the same  
    if( $adminData['password'] !== $password){
        // if not, create variable error 
          header("Location:../index.php?error=errorPassword");
        exit();
    }

     //start session 
    session_start();
    $_SESSION["admin_id"] = $adminData["id"];

    header("Location: ../Pages/dashboard.php");
    exit();
} else {
    header("Location:../index.php?error=emptyInput");
    exit();
}