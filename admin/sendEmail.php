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

        $message = "Dear Employee,\n\n"
        . "I hope this message finds you well. Please find attached your payslip for this month's payment. To ensure the security of your personal information, we have password-protected the file.\n\n"
        . "The password required to open the file is the first four numbers of the email address we have on file for you. Please note that the password is case-sensitive and should be entered exactly as provided.\n\n"
        . "If you have any questions or concerns regarding your payslip or the password, please do not hesitate to reach out to our payroll department.\n\n"
        . "Thank you for your hard work and dedication to our company.\n\n"
        . "Best regards,\n"
        . "Human Resource Department";

        // echo $employeeData["email"];
        $database->sendEmailPayslip($employeeData["email"],"Payslip", $message , $attachment);
    }

    //redirect to pslist
    header("Location: pslist.php?id=$prlistId&status=emailSend");
  }