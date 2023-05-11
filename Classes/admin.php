<?php

class Admin {

    private $database;
    private $date;

    public function __construct( $database) {
        $this->database = $database;
        date_default_timezone_set('Asia/Manila');
        $this->date =  date('Y-m-d H:i:s');
    }
    public function login($email){
        // prepare the SQL statement using the database property
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM employee_login WHERE login_id=?");

         //if execution fail
        if (!$stmt->execute([$email])) {
            header("Location: ../index.php?error=stmtfail");
            exit();
        }

        //fetch the result
        $result = $stmt->fetch();
        
          //if has result return it, else return false
        if ($result) {
            return $result;
        } else {
            $result = false;
            return $result;
        }
    }
    public function findByEmail($email) {
        // prepare the SQL statement using the database property
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM hr_dept WHERE email=?");

         //if execution fail
        if (!$stmt->execute([$email])) {
            header("Location: ../index.php?error=stmtfail");
            exit();
        }

        //fetch the result
        $result = $stmt->fetch();
        
          //if has result return it, else return false
        if ($result) {
            return $result;
        } else {
            $result = false;
            return $result;
        }

    
    }
    public function btnPic($id){
        
        // prepare the SQL statement using the database property
      $stmt = $this->database->getConnection()->prepare("SELECT employees.*,employee_details.picture_path FROM employees
                                                    JOIN employee_details ON employees.id = employee_details.employee_id
                                                   WHERE employees.id=?");

       //if execution fail
      if (!$stmt->execute([$id])) {
          header("Location: ../index.php?error=stmtfail");
          exit();
      }

      //fetch the result
      $result = $stmt->fetchAll();
      
        //if has result return it, else return false
      if ($result) {
          return $result;
      } else {
          $result = false;
          return $result;
      }

    
  }
     public function findEmployeeById($id){

        
          // prepare the SQL statement using the database property
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM employees WHERE status = '1' AND id=?");

         //if execution fail
        if (!$stmt->execute([$id])) {
            header("Location: ../index.php?error=stmtfail");
            exit();
        }

        //fetch the result
        $result = $stmt->fetchAll();
        
          //if has result return it, else return false
        if ($result) {
            return $result;
        } else {
            $result = false;
            return $result;
        }

      
    }

    public function  deleteEmployeeById($id){
          // prepare the SQL statement using the database property
        $stmt = $this->database->getConnection()->prepare("UPDATE employees SET status = '2'  WHERE id=?");

         //if execution fail
        if (!$stmt->execute([$id])) {
            header("Location: ../index.php?error=stmtfail");
            exit();
        }

         // if succesful
         header("Location: ../Pages/employee-list.php");

    }

    public function getEmployeeDetails($employeeId){
          // prepare the SQL statement using the database property
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM employee_details                                               
                                                    WHERE employee_id = ? ");

         //if execution fail
        if (!$stmt->execute([$employeeId])) {
            header("Location: ../index.php?error=stmtfail");
            exit();
        }

        //fetch the result
        $result = $stmt->fetchAll();
        
          //if has result return it, else return false
        if ($result) {
            return $result;
        } else {
            $result = false;
            return $result;
        }

    }

    public function getEmployeePayslip($id){
        
          // prepare the SQL statement using the database property
        // $stmt = $this->database->getConnection()->prepare("SELECT employees.*, employee_details.department, employee_details.salary, 
        //                                             employee_details.sss, employee_details.pagibig, employee_details.philhealth, 
        //                                             employee_details.position, employee_details.branch, employee_details.num_hr, 
        //                                             employee_details.over_time,employee_details.employee_id, employee_details.food_allowance
        //                                             FROM employees
        //                                             JOIN employee_details ON employees.id = employee_details.employee_id
        //                                             WHERE employees.id=?");

         $stmt = $this->database->getConnection()->prepare("SELECT employees.*, employee_details.department, employee_details.rate_per_hour, 
                                                    employee_details.sss, employee_details.pagibig, employee_details.philhealth, 
                                                    employee_details.position, employee_details.branch, employee_details.num_hr, 
                                                    employee_details.over_time, employee_details.employee_id, employee_details.food_allowance
                                                    , employee_details.transpo_allowance
                                                    FROM employees
                                                    JOIN employee_details ON employees.id = employee_details.employee_id
                                                    WHERE employees.id=?");

         //if execution fail
        if (!$stmt->execute([$id])) {
            header("Location: ../index.php?error=stmtfail");
            exit();
        }

        //fetch the result
        $result = $stmt->fetchAll();
        
          //if has result return it, else return false
        if ($result) {
            return $result;
        } else {
            $result = false;
            return $result;
        }

       
    }

    // public function getEmployeePayslipDetails($id){

    //     $stmt = $this->database->getConnection()->prepare("SELECT * FROM prlist
    //                                                  WHERE id=?");

    //     if (!$stmt->execute([$id])) {
    //         header("Location: ../index.php?error=stmtfail");
    //         exit();
    //     }

    //     //fetch the result
    //     $result = $stmt->fetchAll();

    //     //if has result return it, else return false
    //     if ($result) {
    //         return $result;
    //     } else {
    //         $result = false;
    //         return $result;
    //     }

    // }

    public function insertEmployeePayslip($employee, $net, $id,$employeeId,$prlistType){


        // prepare insert statement for employee table
        $sql = "INSERT INTO employee_payslip (date_added,employee, net, file_path, prlist_id, employee_id)
        VALUES (?,?,?,?,?,?);";

     // prepared statement
    $stmt = $this->database->getConnection()->prepare($sql);

    //if execution fail
    if (!$stmt->execute([$this->date,
                         $employee,
                         $net,  
                         "Not generated",
                         $id,
                         $employeeId])) {
        header("Location: ../Pages/employee-register.php?error=stmtfail");

        exit();
    }

    // get the ID of the newly inserted row
    $payslipId = $this->database->getConnection()->lastInsertId();

    // update the payslip_id column in the employee_payslip_form table
    $sql = "UPDATE employee_payslip_form SET payslip_id = ? WHERE employee_id = ? ";
    $stmt = $this->database->getConnection()->prepare($sql);

    // execute statement and check for errors
    if (!$stmt->execute([$payslipId, $employeeId])) {
        header("Location: ../Pages/employee-register.php?error=stmtfail");
        exit();
    }

    //get the latest data of num_hr and overtime
 
    // reset the num_hr and overtime to 0 and put num_hr and overtime ti ain employee_details table 
    // $sql = "UPDATE employee_details SET num_hr = ?, over_time = ? WHERE employee_id = ? ";
    // $stmt = $this->database->getConnection()->prepare($sql);

    // // execute statement and check for errors
    // if (!$stmt->execute(['0','0', $employeeId])) {
    //     header("Location: ../Pages/employee-register.php?error=stmtfail");
    //     exit();
    // }

    // if succesful
    header("Location: ../admin/pslist.php?id=$id&status=created&type=$prlistType");
    }

    public function insertEmployeePayslipForm($fname, $position, $branch, $department,  $date, $date1, $present, $overtime, $salary, $sssChecked,$pagibigChecked, $philhealthChecked, $food_allowance, $transpo_allowance, $employeeId) {

        $sql = "INSERT INTO employee_payslip_form (employee_name, position, branch, department, from_date, to_date, number_present, number_overtime, rate, sss, pagibig, philhealth, food_allowance, transpo_allowance  ,employee_id)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

     // prepared statement
    $stmt = $this->database->getConnection()->prepare($sql);

    //if execution fail
    if (!$stmt->execute([$fname,
                         $position,
                         $branch,
                         $department,
                         $date,
                         $date1,
                         $present,
                         $overtime, 
                         $salary, 
                         $sssChecked, 
                         $pagibigChecked, 
                         $philhealthChecked,
                         $food_allowance,
                         $transpo_allowance,
                         $employeeId])) {
        header("Location: ../Pages/employee-register.php?error=stmtfail");

        exit();
    }

    // if succesful
    header("Location: ../admin/pslist.php?id=$id");
    }


    public function checkprlist ($id) {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM prlist
                                                     WHERE id=?");

         //if execution fail
        if (!$stmt->execute([$id])) {
            header("Location: ../index.php?error=stmtfail");
            exit();
        }

        //fetch the result
        $result = $stmt->fetchAll();
        
          //if has result return it, else return false
        if ($result) {
            $result = true;
            return $result;
        } else {
            $result = false;
            return $result;
        }

        //close connection
        unset($this->database);
    }

    public function getAdminById($id){
        $admin = $this->database->getConnection()->query("SELECT * FROM hr_dept WHERE id = '$id'")->fetch();
        return $admin;
        exit();
    }

    public function getTotalEmployees(){
        $count = $this->database->getConnection()->query("SELECT count(status) FROM employees WHERE status = '1'")->fetchColumn();

        return $count;
     
        exit();
    }

    public function getTotalPendingEmployees(){
        $count = $this->database->getConnection()->query("SELECT count(status) FROM employees WHERE status = '0'")->fetchColumn();

        return $count;

        exit();
    }

     public function getTotalPresent($id){
        // Get today's date
        $today = date('Y-m-d');

        $count = $this->database->getConnection()->query("SELECT count(*) FROM attendance WHERE date = '$today' AND (status = 'LATE' OR status = 'ONTIME' OR status = 'VACATION LEAVE') AND schedule_id = '$id'")->fetchColumn();

        return $count;

        exit();
    }

    public function getEmployee(){
        $stmt = $this->database->getConnection()->query("SELECT * FROM employees WHERE status = '1'")->fetchAll();
        return $stmt;
        exit();
    }

    public function getTotalWarnings($employee_id){
        $count = $this->database->getConnection()->query("SELECT COUNT(status) FROM attendance WHERE employee_id = '$employee_id' AND status = 'ABSENT'")->fetchColumn();
        return $count;
        exit();
    }

   public function getEmployeesByDepartment($department){
    $query = "";
    $employees = "";

    $query ="SELECT employees.*,employee_details.picture_path,employee_details.department,employee_details.department,
                                                employee_details.date_applied,employee_details.date_hired, employee_details.position, employee_details.department_position, employee_details.rate_per_hour  FROM employees 
                                                JOIN employee_details ON employees.id = employee_details.employee_id
                                                WHERE employees.status = '1' AND employee_details.department = '$department'";
    
    $stmt = $this->database->getConnection()->query($query);
    if ($stmt) {
        $employees = $stmt->fetchAll();
    }

    return $employees;
}

    public function getEmployees($id = ""){
        $query = "";
        $employees = "";

        if($id == ""){
            
            $query ="SELECT employees.*,employee_details.picture_path,employee_details.department,employee_details.department,
                                                        employee_details.date_applied,employee_details.date_hired, employee_details.position, employee_details.department_position, employee_details.rate_per_hour FROM employees 
                                                        JOIN employee_details ON employees.id = employee_details.employee_id
                                                        WHERE employees.status = '1'";
            $employees = $this->database->getConnection()->query($query)->fetchAll();
        }else{
             $query ="SELECT employees.*,employee_details.picture_path,employee_details.department, employee_details.department, employee_details.sss,  employee_details.pagibig, employee_details.philhealth,
                                                        employee_details.date_applied,employee_details.date_hired, employee_details.position, employee_details.department_position,
                                                         employee_details.rate_per_hour, employee_login.login_id  FROM employees 
                                                        JOIN employee_details ON employees.id = employee_details.employee_id
                                                        JOIN employee_login ON employees.id = employee_login.employee_id
                                                        WHERE employees.status = '1' AND employees.id = $id";
            $employees = $this->database->getConnection()->query($query)->fetch();
        }
         

        return $employees;

        exit();
    }

    public function getEmployeesSorted(){
        $query = "";
        $employees = "";

        $query ="SELECT employees.*,employee_details.picture_path,employee_details.department,employee_details.department,
                employee_details.date_applied,employee_details.date_hired, employee_details.position, employee_details.department_position, employee_details.rate_per_hour 
            FROM employees 
            JOIN employee_details ON employees.id = employee_details.employee_id
            WHERE employees.status = '1'
            ORDER BY employees.first_name ASC"; // add this line to sort by first name

        $employees = $this->database->getConnection()->query($query)->fetchAll();
        return $employees;
    }

    public function getDepartment(){
        $employees = $this->database->getConnection()->query("SELECT attendance.*,employee_details.,employee_details.department, FROM attendance
                                                        JOIN employee_details ON attendance.employee_id = employee_details.employee_id
                                                        WHERE employees_details.department = 'sales'")->fetchAll();

  

        return $employees;
  
        exit();
    }

    public function searchEmployees($name){
        $data =  $this->database->getConnection()->query("SELECT employees.*,employee_details.picture_path,employee_details.department,employee_details.department,
                                                        employee_details.date_applied,employee_details.date_hired, employee_details.position,employee_details.department_position, employee_details.rate_per_hour FROM employees 
                                                        JOIN employee_details ON employees.id = employee_details.employee_id
                                                    WHERE (first_name LIKE '{$name}%' OR last_name LIKE '{$name}%') AND status = '1' ")->fetchAll();

                                                    
        return $data;

    
        exit();
    }

    public function getPendingEmployees(){
          $pendingEmployees = $this->database->getConnection()->query("SELECT employees.*, employee_details.resume_name,
                                                                                     employee_details.resume_path,
                                                                                     employee_details.picture_path,
                                                                                     employee_details.department,
                                                                                     employee_details.date_applied FROM employees 
                                                        JOIN employee_details ON employees.id = employee_details.employee_id
                                                        WHERE employees.status = '0'")->fetchAll();

        return $pendingEmployees;

      
        exit();
    }

    public function formatDate($date){
         $formatted_date = date('m/d/Y', strtotime($date));

         return $formatted_date;
    }

    public function insertPayslipFilePath($file,$employeeId){
         // prepared statement
         $stmt = $this->database->getConnection()->prepare("UPDATE employee_payslip SET file_path = ? WHERE employee_id = ?");

        //if execution fail
        if (!$stmt->execute([$file,$employeeId])) {
            header("Location: ../Pages/employee-register.php?error=stmtfail");

            exit();
        }
    }

    

     public function acceptEmployee($employeeData){
            // prepared statement
         $stmt = $this->database->getConnection()->prepare("UPDATE employees AS e
                                                      INNER JOIN employee_details AS ed ON e.id = ed.employee_id
                                                      SET e.schedule_id = ?, e.status = ?,  ed.rate_per_hour = ?, ed.department = ?, ed.date_hired = ?,
                                                       ed.position = ?, ed.department_position = ?, ed.employee_type = ?,  ed.branch = ? , ed.vacation_leave = ? ,
                                                        ed.sick_leave = ? , ed.maternity_leave = ?, ed.paternity_leave = ?, ed.health_insurance = ?, ed.christmas_bonus = ?, ed.food_allowance = ?, ed.transpo_allowance = ? 
                                                      WHERE e.id = ?");

        //if execution fail
        if (!$stmt->execute([$employeeData['schedule'],
                            '1',              
                             $employeeData['rate'],
                             $employeeData['department'],
                             $this->date,
                             $employeeData['position'],
                             $employeeData['departmentPosition'],
                             $employeeData['type'],
                             $employeeData['branch'],
                             $employeeData['vacationLeave'],
                             $employeeData['sickLeave'],
                             
                             90,
                             
                             7,
                             $employeeData['healthInsurance'],
                             $employeeData['christmasBonus'],
                             $employeeData['foodAllowance'],
                             $employeeData['transpoAllowance'],
                             $employeeData['employeeId']
                             ])) {
            header("Location: ../Pages/employee-register.php?error=stmtfail");

            exit();
        }

        $sql = "UPDATE employees as e 
                INNER JOIN employee_details AS ed ON e.id = ed.employee_id
                SET ";
        $values = array();

        // Build the SQL query and parameter values based on the checkboxes that are checked
        foreach ($employeeData['beneficiaries'] as $key => $value) {
        // Append the column name and parameter value to the SQL query
            // $columnName = 'column' . ($key + 1);
            $sql .= $value . ' = ?, ';
    
            // Append the parameter value to the array of parameter values
            $values[] = '1';
        }

        // Remove the trailing comma and space from the query
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE e.id = ?";

        // Prepare the statement
        $stmt2 = $this->database->getConnection()->prepare($sql);
        $params = array_merge($values, array($employeeData['employeeId']));


         //if execution fail
        if (!$stmt2->execute($params)) {
            header("Location: ../Pages/employee-register.php?error=stmtfail");

            exit();
        }

        //generate employee account
        $employeeAccount = $this->generateEmployeeIDAndPassword($employeeData['employeeLastName']);

        //if selected rfid value is not 0, updated RFID_card
        if($employeeData["rfidCard"] != "0"){
              // prepared statement
         $stmt = $this->database->getConnection()->prepare("UPDATE RFID_card SET  employee_id = ?                                  
                                                      WHERE serial_number = ?");

        //if execution fail
        if (!$stmt->execute([$employeeData["employeeId"],$employeeData["rfidCard"]])) {
            header("Location: ../Pages/employee-register.php?error=stmtfail");

            exit();
        }
        }

        //save account to database
        $this->saveEmployeeIDAndPassword($employeeAccount[0],$employeeAccount[1],$employeeData['employeeEmail'],$employeeData['employeeId'],$employeeData['position']);



        //if success go to dashboard
        header("Location: ../Pages/dashboard.php");

        exit();
    }

    

    public function generateEmployeeIDAndPassword($employeeLastName){

        // Generate a random 4-digit number
        $randomNumber = rand(1000, 9999);

        // Convert the number to a string and concatenate lastname
        $employeID = strval($randomNumber).strtoupper($employeeLastName);

        //return the id and password
        return [$employeID,$employeeLastName];

    }

    public function saveEmployeeIDAndPassword($employeeUserID, $employeePassword,$employeeEmail,$employeeId,$employeePosition){
        // prepare insert statement for employee_login table
         $sql = "INSERT INTO employee_login (login_id,login_password,employee_id,position) VALUES (?,?,?,?);";

         // prepared statement
         $stmt = $this->database->getConnection()->prepare($sql);

         //hash password
        $hashedpwd = password_hash($employeePassword, PASSWORD_DEFAULT);
         //if execution fail
        if (!$stmt->execute([$employeeUserID,$hashedpwd,$employeeId,$employeePosition])) {
            header("Location: ../Pages/dashboard.php?error=stmtfail");
            exit();
            
        }
        //send email employee his/her id and password
    $emailSubject = "Congratulations! Your Job Application has been Accepted";
    $emailBody = "Dear Applicant,\n\n"
    . "We are thrilled to inform you that you have been accepted for the position you applied for at our company. Congratulations on this exciting news! We were very impressed with your qualifications and experience, and we are confident that you will make a valuable addition to our team.\n\n"
    . "As you know, the position comes with a lot of responsibility, but we believe that you have the skills and determination to excel in this role. We look forward to seeing your contributions to the company and working with you closely.\n\n"
    . "For you to start your career at our company, we've provided your account to log in on our system. Please take note of the following:\n\n"
    . "Username: " . $employeeUserID . "\n"
    . "Password: " . $employeePassword . "\n\n"
    . "Please let us know if you have any questions or concerns, and we will be more than happy to help. Once again, congratulations on this achievement, and we are excited to welcome you aboard!\n\n"
    . "Best regards,\n"
    . "Human Resource Department";

        //send email employee his/her id and password 
        $this->database->sendEmail($employeeEmail,$emailSubject, $emailBody);

        //if success saving account 
        header("Location: ../Pages/dashboard.php?success=acceptEmployee");
        exit();
    }

    public function getAllEmployeePayslip($prlistId) {
        $employeePayslip =  $this->database->getConnection()->query("SELECT id,file_path FROM employee_payslip WHERE prlist_id = '$prlistId' ")->fetchAll();
            return $employeePayslip;

            
            exit();
    }

    public function getAllRfidCard(){
           $rfid =  $this->database->getConnection()->query("SELECT * FROM RFID_card")->fetchAll();
            return $rfid;
            
            exit();
    }

    public function getEmployeePayslipTable($id) {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM employee_payslip_form WHERE payslip_id=?");

         //if execution fail
        if (!$stmt->execute([$id])) {
            header("Location: ../Pages/employee-register.php?error=stmtfail");
            exit();
    }

    $result = $stmt->fetch();
        
          //if has result true, else return false
        if ($result) {
            return $result;
        } else {
            return false;
        }

        //close connection
        unset($this->database);
    }
    public function selectEmployeeSched($sched){
        $employee = $this->database->getConnection()->prepare("SELECT id FROM employees WHERE schedule_id = ?");
        $employee->execute([$sched]);
        return $employee->fetchAll();

        exit();
    }

    public function getLoginId($employeeId){
        $loginId = $this->database->getConnection()->prepare("SELECT login_id FROM employee_login WHERE employee_id = ? ");
        $loginId->execute([$employeeId]);
        return $loginId->fetch();

        exit();
    }

     public function checkAttendance($id){
             // Get today's date
        $today = date('Y-m-d');

        $employee = $this->database->getConnection()->prepare("SELECT * FROM attendance WHERE employee_id = ? AND date = '$today' AND (status = 'ONTIME' OR status = 'LATE' OR status = 'VACATION LEAVE' OR status = 'MATERNITYLEAVE' OR status = 'PATERNITY LEAVE')");
         $employee->execute([$id]);
        return $employee->fetchAll();

      

        exit();
    }

    public function checkData($employeeData, $pictureData = []){
        if(!empty($pictureData)){
             //check if the file extension is in the array $allowed
            if (in_array($pictureData['fileActualExt'], $pictureData['allowed'])){

                //seperate filename
                $newFileName = explode('.',$pictureData['fileName']);

                //picture
                $fileNameNew = uniqid('', true) . "." . $pictureData['fileActualExt'];
                //file destination
                $fileDestination = '../Uploads/' . $fileNameNew;

                
                if (move_uploaded_file($pictureData['fileTmpName'],$fileDestination))  {

                    $this->updateEmployeeData($employeeData,$fileNameNew);
         
                } else {
                    echo "move_uploaded_file error";
                }
            }else {
                echo "You can't upload this type of file!";
            }
        }else{
            $this->updateEmployeeData($employeeData);
        }
  

            
    }

    public function updateEmployeeData($employeeData,$picturePath = ""){

        if($picturePath != ""){
             // prepared statement
         $stmt = $this->database->getConnection()->prepare("UPDATE employees AS e
                                                      INNER JOIN employee_details AS ed ON e.id = ed.employee_id
                                                      SET e.first_name = ?, e.last_name = ?,  e.email = ?, e.contact = ?, ed.department_position = ?, ed.picture_path = ?                   
                                                      WHERE e.id = ?");

        //if execution fail
        if (!$stmt->execute([$employeeData['firstName'],
                             $employeeData['lastName'],
                             $employeeData['email'],
                             $employeeData['contactNo'],
                             $employeeData['departmentPosition'],
                             $picturePath,
                             $employeeData['employeeID']
                             ])) {
            header("Location: ../Pages/employee-register.php?error=stmtfail");

            exit();
        }
            
        }else{
             // prepared statement
         $stmt = $this->database->getConnection()->prepare("UPDATE employees AS e
                                                      INNER JOIN employee_details AS ed ON e.id = ed.employee_id
                                                      SET e.first_name = ?, e.last_name = ?,  e.email = ?, e.contact = ?, ed.department_position = ?                  
                                                      WHERE e.id = ?");

        //if execution fail
        if (!$stmt->execute([$employeeData['firstName'],
                             $employeeData['lastName'],
                             $employeeData['email'],
                             $employeeData['contactNo'],
                             $employeeData['departmentPosition'],
                             $employeeData['employeeID']
                             ])) {
            header("Location: ../Pages/employee-register.php?error=stmtfail");

            exit();
        }
        }
          


        //UPDATE BENEFICARIES =================================================

        $sql = "UPDATE employees as e 
                INNER JOIN employee_details AS ed ON e.id = ed.employee_id
                SET ";
        $values = array();

        // Build the SQL query and parameter values based on the checkboxes that are checked
        foreach ($employeeData['beneficiaries'] as $key => $value) {
        // Append the column name and parameter value to the SQL query
            // $columnName = 'column' . ($key + 1);
            $sql .= $value . ' = ?, ';
    
            // Append the parameter value to the array of parameter values
            $values[] = '1';
        }

        // Remove the trailing comma and space from the query
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE e.id = ?";

     
        // Prepare the statement
        $stmt2 = $this->database->getConnection()->prepare($sql);
        $params = array_merge($values, array($employeeData['employeeID']));


         //if execution fail
        if (!$stmt2->execute($params)) {
            header("Location: ../Pages/employee-register.php?error=stmtfail");

            exit();
        }
    }
}

    

class Payroll{
    private $database;
    private $date;

    public function __construct(Database $database) {
        $this->database = $database;
        date_default_timezone_set('Asia/Manila');
        $this->date =  date('Y-m-d H:i:s');
    }
public function payrollList(){
        $prlist =  $this->database->getConnection()->query("SELECT * FROM prlist WHERE Status = 1")->fetchAll();
        return $prlist;
        exit();
}
public function payrollDetails($id){
    $prlist = $this->database->getConnection()->prepare("SELECT code, start, end, type FROM prlist WHERE id=?");
    $prlist->execute([$id]);
    return $prlist->fetchAll();
}

public function Insertpayroll($prlist){
    $sql = "INSERT INTO prlist (date, code, start, end, type,Status)
       VALUES (?,?,?,?,?,?);";

   $stmt = $this->database->getConnection()->prepare($sql);

   if (!$stmt->execute([$this->date,
    $prlist['code'],
    $prlist['start'],
    $prlist['end'],
    $prlist['type'],
    1])) {
    header("Location: ../admin/prlist.php?error=stmtfail");
       exit();
       }
}
public function updatePayroll($id, $code, $start, $end, $type){
    $stmt = $this->database->getConnection()->prepare("UPDATE prlist SET code = ?, start = ?, end = ?, type = ? WHERE id = ?");

    if (!$stmt->execute([$code, $start, $end, $type, $id])) {
    header("Location: ../admin/prlist.php?error=stmtfail");
       exit();
       }

       header("Location: ../admin/prlist.php?status=updated");
}

public function updatePayslip($employeeId,$branch, $email){

    $stmt = $this->database->getConnection()->prepare("UPDATE employees AS e
                                                       INNER JOIN employee_details AS ed ON e.id = ed.employee_id
                                                       INNER JOIN employee_payslip AS ep ON e.id = ep.employee_id
                                                       SET e.email = ?, ed.branch = ?, ep.file_path = ?
                                                       WHERE e.id = ?");

    if (!$stmt->execute([$email, $branch,"Not generated", $employeeId])) {
        header("Location: ../admin/pslist.php?error=stmtfail");
       exit();
    }

}

public function deletePayslipform($pslistId, $prlistId,$prlistType) {
    try {

        //delete employee payslip form 
        $sql = "DELETE FROM employee_payslip_form WHERE payslip_id=?";
        $stmt= $this->database->getConnection()->prepare($sql);
        $stmt->execute([$pslistId]);

        if (!$stmt->execute([$pslistId])) {
            header("Location: ../admin/pslist.php?error=stmtfail");
               exit();
        }

        //delete employee payslip
        $sql = "DELETE FROM employee_payslip WHERE id=?";
        $stmt= $this->database->getConnection()->prepare($sql);
        $stmt->execute([$pslistId]);

        if (!$stmt->execute([$pslistId])) {
            header("Location: ../admin/pslist.php?error=stmtfail");
               exit();
        }

        header("Location: ../admin/pslist.php?id=$prlistId&status=deleted&type=$prlistType");
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

public function archivePayroll($id) {
    $stmt = $this->database->getConnection()->prepare("UPDATE prlist SET Status = '0'  WHERE id=?");
    

         //if execution fail
        if (!$stmt->execute([$id])) {
            header("Location: ../prlist.php?error=stmtfail");
            exit();
        }

         // if succesful
         header("Location: ../Pages/prlist.php");

    }

public function payslipList($prlistid){
    $stmt = $this->database->getConnection()->prepare("SELECT * FROM employee_payslip WHERE prlist_id=?");
    //if execution fail
    if (!$stmt->execute([$prlistid])) {
        header("Location: ../index.php?error=stmtfail");
        exit();
    }
    //fetch the employeeID
    $pslist = $stmt->fetchAll();
    return $pslist;
}

public function calculateTotalHourAndOvertime($date, $date1, $employeeId)
{
    $stmt = $this->database->getConnection()->prepare("SELECT SUM(num_hr) as sahod, SUM(over_time) as overtime FROM attendance WHERE date BETWEEN :dateFrom AND :dateTo AND employee_id = :employeeId");

    if (!$stmt->execute(array(':dateFrom' => $date, ':dateTo' => $date1, ':employeeId' => $employeeId))) {
        // Handle the execution failure here
        return false;
    }
 
    $totalHours = $stmt->fetch();
    return $totalHours;
}

public function getEmployeeDateHired($employeeId)
{
    $stmt = $this->database->getConnection()->prepare("SELECT date_hired,num_hr,over_time FROM employee_details WHERE employee_id = ? ");

    if (!$stmt->execute([$employeeId])) {
        // Handle the execution failure here
        return false;
    }
 
    $date_hired = $stmt->fetch();
    return $date_hired;
}

public function ArchiveList(){
    $prlist =  $this->database->getConnection()->query("SELECT * FROM prlist WHERE Status = 0")->fetchAll();
    return $prlist;
    exit();

}
}

