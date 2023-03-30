<?php

if(isset($_POST['submit'])){
    require '../Classes/database.php';
    require '../Classes/employee.php';

    $database = new Database();
    $employee = new Employee($database);

    //employee data
    $employeeData = array(
        'firstName' => trim($_POST["first-name"]),
        'lastName' => trim($_POST["last-name"]),
        'email' => trim($_POST["email"]),
        'contactNo' => trim($_POST["contact-no"]),
        'address' => trim($_POST["address"]),
        'gender' => trim($_POST["gender"]),
        'department' => $_POST["department"],
      
    );

  
    //file data
    $fileData = array(
        'fileName' => $_FILES['resume']['name'],
        'fileTmpName' => $_FILES['resume']['tmp_name'],
        'fileSize' => $_FILES['resume']['size'],
        'fileError' => $_FILES['resume']['error'],
        'fileType' => $_FILES['resume']['type'],

    );

    $fileData2 = array(
        'fileName' => $_FILES['picture']['name'],
        'fileTmpName' => $_FILES['picture']['tmp_name'],
        'fileSize' => $_FILES['picture']['size'],
        'fileError' => $_FILES['picture']['error'],
        'fileType' => $_FILES['picture']['type'],

    );

    //seperate the filename and its extension - file
    $fileExt = explode('.', $fileData['fileName']);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('pdf');

    $fileExt2 = explode('.', $fileData2['fileName']);
    $fileActualExt2 = strtolower(end($fileExt2));
    $allowed2 = array('jpeg','png','jpg');

    //resume and picture data
    $resumeAndPictureData = array(
        'allowed' => $allowed,
        'allowed2' => $allowed2,
        'fileActualExt' => $fileActualExt,
        'fileActualExt2' => $fileActualExt2,
        'fileName' => $fileData['fileName'],
        'fileName2' => $fileData2['fileName'],
        'fileTmpName' => $fileData['fileTmpName'],
        'fileTmpName2' => $fileData2['fileTmpName']
    );

    //check if any input is  empty
    foreach($employeeData as $data){
        if(empty($data)){
            //return to employee register page
            header("Location: ../Pages/employee-register.php?error=emptyInput");
            exit();
        }
    }


    //check if records already exist
    if($employee->findByEmail($employeeData['email'])){

         //return to employee register page
        header("Location: ../Pages/employee-register.php?error=alreadyExist");
        exit();
    }


    //if theres no error from the resume file
    if ( $fileData['fileError'] === 0 && $fileData2['fileError'] === 0) {

        $employee->checkData($resumeAndPictureData,
                             $employeeData);
    } else {
        echo "There was an error while uploading the file";
        exit();
    }


}