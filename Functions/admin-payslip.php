<?php
//Including Database configuration file.
require '../Classes/admin.php';
require '../Classes/database.php';

$database = new Database();
$admin = new Admin($database);

//Getting value of "search" variable from "script.js".
if (isset($_POST['id'])) {

//Search box value assigning to $name variable.
   $employeeId = $_POST['id'];

    $employeeData = $admin->getEmployeePayslip($employeeId);
    
    // var_dump($employeeData);    
    // exit();

    // header('Content-Type: application/json');
    echo json_encode($employeeData);


}else{
    echo "none";
}
  
