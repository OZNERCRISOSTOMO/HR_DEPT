<?php

if(isset($_POST['submit'])){
    require '../Classes/database.php';
    require '../Classes/admin.php';

    $database = new Database();
    $admin = new Admin($database);

    // employee data
    $employeeData = array(
        'employeeId'  => $_POST['employee_id'],
        'employeeEmail'  => $_POST['employee_email'],
        'employeeLastName'  => $_POST['employee_lastname'],
        'department'  => $_POST['department'],
        'position'  => $_POST['position'],
        'schedule'  => $_POST['schedule'],
        'branch'  => trim($_POST['branch']),
        'rate'  => $_POST['rate'],
        'vacationLeave' => trim($_POST['vacation-leave']),
        'type' => $_POST['type'],
        'healthInsurance' => isset($_POST['health-insurance']) ? 1 : 0 ,
        'christmasBonus' => isset($_POST['christmas-bonus']) ? 1 : 0 ,
        'beneficiaries'  => $_POST['beneficiaries'],
    );


     //check if any input is  empty
    foreach($employeeData as $data){
        if(empty($data)){
            //return to employee register page
            header("Location: ../Pages/dashboard.php");
            exit();
        }
    }

    //update employee details
    $admin->acceptEmployee($employeeData);

}else{
    header("Location: ../Pages/dashboard.php");
}
