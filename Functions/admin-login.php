<?php

if ($_POST['email'] !== '' && $_POST['password'] !== '' && isset($_POST['submit'])){

require '../Classes/admin.php';
require '../Classes/database.php';


// include '../includes/autoload-class.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $database = new Database();
    $admin = new Admin($database);


    $adminData = $admin->login($email);

    //SELECT * FROM employee_login WHERE login_id='2026AMIT';

    $adminEmpId = $adminData['employee_id'];
    $adminUser = $adminData['login_id'];
    $adminPass = $adminData['login_password'];
    $adminPosition = $adminData['position'];

    $adminDep = $admin->getEmployeeDetails($adminEmpId);
    //SELECT * FROM employee_details WHERE employee_id = $adminEmpID";

    $dept = $adminDep[0]['department'];
    // human-resource

    $adminAttendance = $admin->checkAttendance($adminEmpId);
    //SELECT * FROM attendance WHERE employee_id = $adminEmpId AND date = 'date_now' 
    //AND (status = 'ONTIME' OR status = 'LATE' OR status = 'VACATION LEAVE'); 


    //check if email exist 
    if(!$adminData){
          header("Location:../index.php?error=errorEmail");
        exit();
    }

    $hashed_input_password = password_hash($password, PASSWORD_DEFAULT);
    //check if password not the same  
    if(!password_verify($password, $adminPass)){
        // if not, create variable error 
          header("Location:../index.php?error=errorPassword");
        exit();
    }
    if($dept !== 'human-resource'){
        // if you are not on the department 
        header("Location:../index.php?error=notDept");
        exit();
    }
    if($adminPosition !== 'admin'){
        // if not admin 
            header("Location:../index.php?error=notAdmin");
        exit();
    }
    if(!$adminAttendance){
            header("Location:../index.php?error=absent");
        exit();
    }

     //start session 
    session_start();
    $_SESSION["admin_id"] = $adminEmpId;

    header("Location: ../Pages/dashboard.php");
    exit();
} else {
    header("Location:../index.php?error=emptyInput");
    exit();
}