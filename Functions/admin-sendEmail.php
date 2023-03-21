<?php
require '../Classes/admin.php';
require '../Classes/database.php';

$database = new Database();
$admin = new Admin($database);

if(isset($_POST['submit'])){
    $employeeId = $_POST['employee-id'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    $employee = $admin->findEmployeeById($employeeId);


    //if there is attachment
    if(isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK){
        $attachmentData = array(
            'name' => $_FILES['attachment']['name'],
            'tmpName' => $_FILES['attachment']['tmp_name'],
        );
        $database->sendEmail($employee['email'],$subject,$message,$attachmentData);
   

    }else{
        $database->sendEmail($employee['email'],$subject,$message);
  
    }
    
    header("Location: ../Pages/dashboard.php?success=emailSent");
}else{
    header("Location: ../Pages/dashboard.php");
}