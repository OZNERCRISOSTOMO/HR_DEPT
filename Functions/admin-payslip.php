<?php
//Including Database configuration file.
require '../Classes/admin.php';
require '../Classes/database.php';

$database = new Database();
$admin = new Admin($database);
$payroll = new Payroll($database);

//Getting value of "search" variable from "script.js".
if (isset($_POST['id'])) {

//Search box value assigning to $name variable.
   $employeeId = $_POST['id'];
   $dateFrom = $_POST["dateFrom"];
   $dateTo = $_POST["dateTo"];

   $data = $payroll->calculateTotalHourAndOvertime($dateFrom, $dateTo, $employeeId);
    $employeeData = $admin->getEmployeePayslip($employeeId);
    
    // Combine the data into a single array.
    $combinedData = array(
        "employeeData" => $employeeData,
        "data" => $data
     );
  

    // header('Content-Type: application/json');
    echo json_encode($combinedData);


}else{
    echo "none";
}
  
