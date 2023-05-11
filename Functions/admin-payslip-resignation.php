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

   //get the date hired from employee details
   $date_hired = $payroll->getEmployeeDateHired($employeeId);
    
    // Combine the data into a single array.
    // $combinedData = array(
    //     "employeeData" => $employeeData,
    //     "data" => $data
    //  );
    
    // $datetime = $date_hired[0]["date_hired"];
    // $date = date('Y-m-d', strtotime($datetime));
    // echo $date; // Output: 2023-04-25

    // header('Content-Type: application/json');
    echo json_encode($date_hired);


}else{
    echo "none";
}
  
