<?php

if(isset($_POST['submit'])){
    require '../Classes/database.php';
    require '../Classes/admin.php';

    $database = new Database();
    $admin = new Admin($database);

    //employee data
    $employeeData = array(
        'employeeID' => $_POST["employee-ID"],
        'firstName' => trim($_POST["employee-fname"]),
        'lastName' => trim($_POST["employee-lname"]),
        'email' => $_POST["employee-email"],
        'departmentPosition' => trim($_POST["employee-department-position"]),
        'contactNo' => trim($_POST["employee-contact"]),
        'beneficiaries'  => $_POST['beneficiaries'],
       
    );

  
    //file data
    $fileData = array(
        'fileName' => $_FILES['employee-picture']['name'],
        'fileTmpName' => $_FILES['employee-picture']['tmp_name'],
        'fileSize' => $_FILES['employee-picture']['size'],
        'fileError' => $_FILES['employee-picture']['error'],
        'fileType' => $_FILES['employee-picture']['type'],

    );

 
    //seperate the filename and its extension - file
    $fileExt = explode('.', $fileData['fileName']);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpeg','png','jpg');


    //resume and picture data
    $pictureData = array(
        'allowed' => $allowed,
        'fileActualExt' => $fileActualExt,
        'fileName' => $fileData['fileName'],
        'fileTmpName' => $fileData['fileTmpName'],

    );

  

    //if theres a picture 
    if ( $fileData['fileError'] === 0 ) {

        $admin->checkData($employeeData,$pictureData);
    } 

    if ( $fileData['fileError'] === 4 ) {

         $admin->checkData($employeeData);
    } 

    header("Location: ../Pages/employee-list.php");
       
    
}