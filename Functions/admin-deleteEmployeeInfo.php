<?php
//Including Database configuration file.
require '../Classes/admin.php';
require '../Classes/database.php';

$database = new Database();
$admin = new Admin($database);

if (isset($_POST['submit'])) {
    $employeeId = $_POST["employee-id"];
    
    $admin->deleteEmployeeById($employeeId);

}




  
