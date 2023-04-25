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
        'departmentPosition'  => $_POST['department-position'],
        'schedule'  => $_POST['schedule'],
        'branch'  => trim($_POST['branch']),
        'rate'  => $_POST['rate'],
        'vacationLeave' => trim($_POST['vacation-leave']),
        'sickLeave' => trim($_POST['sick-leave']),
        'type' => $_POST['type'],
        'healthInsurance' => isset($_POST['health-insurance']) ? 1 : 0 ,
        'christmasBonus' => isset($_POST['christmas-bonus']) ? 1 : 0 ,
        'foodAllowance' => isset($_POST['food-allowance']) ? $_POST['food-allowance'] : 0 ,
        'transpoAllowance' => isset($_POST['transpo-allowance']) ? $_POST['transpo-allowance'] : 0 ,
        'beneficiaries'  => $_POST['beneficiaries'],
        'rfidCard'  => $_POST['rfid-card'],
    );


    //update employee details
    $admin->acceptEmployee($employeeData);

}else{
    header("Location: ../Pages/dashboard.php");
}
