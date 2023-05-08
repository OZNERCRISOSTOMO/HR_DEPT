<?php

 require_once __DIR__ . '/vendor/autoload.php';
 require '../Classes/admin.php';
 require '../Classes/database.php';

  if(isset($_POST["submit-sendEmail"])){
    
    $database = new Database();
    $admin = new Admin($database);
    $payslip = new Payroll($database);

    $prlistId = $_POST["prlist-id"];

    $employees = $payslip->payslipList($prlistId);

    //check first if all files is generated 
    foreach ($employees as $employee) {
        //check first if file path is generated
        if($employee["file_path"] == "Not generated"){
             header("Location: pslist.php?id=$prlistId&status=notGenerated");
             exit();
        }
    }

    
    foreach ($employees as $employee) {
        //check first if file path is generated
        // if($employee["file_path"] == "Not generated"){
        //      header("Location: pslist.php?id=$prlistId&status=notGenerated");
        //      exit();
        // }
        
        //get the email of employees
        [$employeeData] = $admin->findEmployeeById($employee['employee_id']);
        $employeeEmail = $employeeData["email"];

        //get the login_id from employee_login
        $loginId =  $admin->getLoginId($employee["employee_id"]);
    
        //extract the 4 number and set it as password
        $password = preg_replace("/[^0-9]/", "", $loginId["login_id"]);
        

        //File details
        $fileDirectory = "../Uploads/";
        $fileName = $employee["file_path"];
        $filePath = $fileDirectory . $fileName;

        $attachment = [
            'path' => $filePath,      // File path of the attachment
            'name' => $fileName        // Name of the attachment file
        ];

        $message = "Password: ". $password;

        // echo $employeeData["email"];
        $database->sendEmailPayslip($employeeData["email"],"Payslip", $message , $attachment);
    }

    //redirect to pslist
    header("Location: pslist.php?id=$prlistId&status=emailSend");
  }