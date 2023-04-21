<?php

class Employee{

    private $database;
    private $date;

    public function __construct(Database $database) {
        $this->database = $database;
        date_default_timezone_set('Asia/Manila');
        $this->date =  date('Y-m-d H:i:s');
    }

    public function findByEmail($email){
          // prepare the SQL statement using the database property
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM employees WHERE email=?");

         //if execution fail
        if (!$stmt->execute([$email])) {
            header("Location: ../Pages/employee-register.php?error=stmtfail");
            exit();
        }

        //fetch the result
        $result = $stmt->fetch();
        
          //if has result true, else return false
        if ($result) {
            return true;
        } else {
            return false;
        }

    }

    public function checkData($resumeAndPictureData, $employeeData){
         //check if the file extension is in the array $allowed
        if (in_array($resumeAndPictureData['fileActualExt'], $resumeAndPictureData['allowed']) &&
             in_array($resumeAndPictureData['fileActualExt2'], $resumeAndPictureData['allowed2']) ) {

            //seperate filename
            $newFileName = explode('.',$resumeAndPictureData['fileName']);
            $newFileName2 = explode('.',$resumeAndPictureData['fileName2']);

            //resume
            $fileNameNew = uniqid('', true) . "." . $resumeAndPictureData['fileActualExt'];
           //file destination
            $fileDestination = '../Uploads/' . $fileNameNew;

            
            //picture
            $fileNameNew2 = uniqid('', true) . "." . $resumeAndPictureData['fileActualExt2'];
              //file destination
            $fileDestination2 = '../Uploads/' . $fileNameNew2;

            // if (move_uploaded_file($fileTmpName, $fileDestination) ) {
            if (move_uploaded_file($resumeAndPictureData['fileTmpName'],$fileDestination) &&
                move_uploaded_file($resumeAndPictureData['fileTmpName2'],$fileDestination2))  {

                $this->registerEmployee($employeeData, $newFileName[0], $fileNameNew,$fileNameNew2);
         
            } else {
                echo "move_uploaded_file error";
            }
        } else {
            echo "You can't upload this type of file!";
        }
    }



    public function registerEmployee($employeeData,$resume_name, $resume_path, $picture_path){

        // prepare insert statement for employee table
         $sql = "INSERT INTO employees (first_name,last_name, email, gender, address, contact, status)
            VALUES (?,?,?,?,?,?,?);";

         // prepared statement
        $stmt = $this->database->getConnection()->prepare($sql);

        //if execution fail
        if (!$stmt->execute([$employeeData['firstName'],
                             $employeeData['lastName'],
                             $employeeData['email'],
                             $employeeData['gender'],
                             $employeeData['address'],
                             $employeeData['contactNo'],
                             "0"])) {
            header("Location: ../Pages/employee-register.php?error=stmtfail");

            exit();
        }
        
        // get the ID of the inserted employee record
        // prepare the SQL statement using the database property
        $stmtEmployeeID = $this->database->getConnection()->prepare("SELECT id FROM employees WHERE email=?");

         //if execution fail
        if (!$stmtEmployeeID->execute([$employeeData['email']])) {
            header("Location: ../index.php?error=stmtfail");
            exit();
        }
        //fetch the employeeID
        $employeeId = $stmtEmployeeID->fetchColumn();

        // prepare insert statement for employee_details table
        $sql2 = "INSERT INTO employee_details (resume_name, resume_path, picture_path, department,date_applied,employee_id) 
                VALUES (?,?,?,?,?,?);";

    
         // prepared statement
        $stmt2 = $this->database->getConnection()->prepare($sql2);

         //if execution fail
        if (!$stmt2->execute([$resume_name,$resume_path,$picture_path, $employeeData['department'],$this->date,$employeeId])) {
            header("Location: ../Pages/employee-register.php?error=stmtfail");
            //close connection
            unset($this->database);
            exit();
        }

        //send email
        $this->database->sendEmail($employeeData['email'],"Succesfully register","Your application has been submitted");

        //if sucess uploading file, go to this 👇 page
        header("Location: ../Pages/employee-register-confirmation.php?success=success"); 
        exit();

    }

    public function acceptEmployee($employeeData){
        // prepared statement
         $stmt = $this->database->getConnection()->prepare("INSERT INTO employees (first_name,last_name, email, gender, address, contact, status)
            VALUES (?,?,?,?,?,?,?);");
    }
    public function attendanceList(){
        $attlist =  $this->database->getConnection()->query("SELECT * FROM attendance")->fetchAll();
        return $attlist;
        exit();
    }

}

