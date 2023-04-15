<?php

class Admin {

    private $database;
    private $date;

    public function __construct(Database $database) {
        $this->database = $database;
        date_default_timezone_set('Asia/Manila');
        $this->date =  date('Y-m-d H:i:s');
    }

    public function findByEmail($email) {
        // prepare the SQL statement using the database property
        $stmt = $this->database->connect()->prepare("SELECT * FROM hr_dept WHERE email=?");

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

        //close connection
        unset($this->database);
    }
     public function findEmployeeById($id){
        
          // prepare the SQL statement using the database property
        $stmt = $this->database->connect()->prepare("SELECT * FROM employees
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
            return $result;
        } else {
            $result = false;
            return $result;
        }

        //close connection
        unset($this->database);
    }

    public function getEmployeePayslip($id){
        
          // prepare the SQL statement using the database property
        $stmt = $this->database->connect()->prepare("SELECT employees.*, employee_details.department, employee_details.salary, employee_details.sss,employee_details.pagibig ,employee_details.philhealth, employee_details.position, employee_details.branch  FROM employees
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

        //close connection
        unset($this->database);
    }

    public function insertEmployeePayslip($employee, $net, $id){
        // prepare insert statement for employee table
        $sql = "INSERT INTO employee_payslip (date_added,employee, net, file_path, prlist_id)
        VALUES (?,?,?,?,?);";

     // prepared statement
    $stmt = $this->database->connect()->prepare($sql);

    //if execution fail
    if (!$stmt->execute([$this->date,
                         $employee,
                         $net,
                         "Not generated",
                         $id])) {
        header("Location: ../Pages/employee-register.php?error=stmtfail");

        exit();
    }

    // if succesful
    header("Location: ../admin/pslist.php?id=$id");
    }

    public function insertEmployeePayslipForm($employee_name, $position, $branch, $department, $fromdate, $todate, $present, $overtime, $rate, $sss, $pagibig, $philhealth) {

        $sql = "INSERT INTO employee_payslip_form (employee_name, position, branch, department, from_date, to_date, number_present, number_overtime, rate, sss, pagibig, philhealth)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";

     // prepared statement
    $stmt = $this->database->connect()->prepare($sql);

    //if execution fail
    if (!$stmt->execute([$employee_name,
                         $position,
                         $branch,
                         $department,
                         $fromdate,
                         $todate,
                         $present,
                         $overtime, 
                         $rate, 
                         $sss, 
                         $pagibig, 
                         $philhealth])) {
        header("Location: ../Pages/employee-register.php?error=stmtfail");

        exit();
    }

    // if succesful
    header("Location: ../admin/pslist.php?id=$id");
    }


    public function checkprlist ($id) {
        $stmt = $this->database->connect()->prepare("SELECT * FROM prlist
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

    public function getAdmin(){
        $admin = $this->database->connect()->query("SELECT * FROM hr_dept WHERE id = 1")->fetch();
        return $admin;
        exit();
    }

    public function getTotalEmployees(){
        $count = $this->database->connect()->query("SELECT count(*) FROM employees WHERE status = '1' ")->fetchColumn();

        return $count;
        //close connection
        unset($this->database);
        exit();
    }

    public function getTotalPendingEmployees(){
        $count = $this->database->connect()->query("SELECT count(*) FROM employees WHERE status = '0' ")->fetchColumn();

        return $count;
        //close connection
        unset($this->database);
        exit();
    }

    public function getEmployees(){
        $employees = $this->database->connect()->query("SELECT employees.*,employee_details.picture_path,employee_details.department,employee_details.department,employee_details.date_applied FROM employees 
                                                        JOIN employee_details ON employees.id = employee_details.employee_id
                                                        WHERE employees.status = '1'")->fetchAll();

        return $employees;
        exit();
    }

    public function getDepartment(){
        $employees = $this->database->connect()->query("SELECT attendance.*,employee_details.,employee_details.department, FROM attendance
                                                        JOIN employee_details ON attendance.employee_id = employee_details.employee_id
                                                        WHERE employees_details.department = 'sales'")->fetchAll();

  

        return $employees;
        exit();
    }

    public function searchEmployees($name){
        $data =  $this->database->connect()->query("SELECT employees.*,employee_details.picture_path, employee_details.department,employee_details.date_applied FROM employees 
                                                    JOIN employee_details ON employees.id = employee_details.employee_id 
                                                    WHERE (first_name LIKE '{$name}%' OR last_name LIKE '{$name}%') AND status = '1' ")->fetchAll();
        return $data;
        exit();
    }

    public function getPendingEmployees(){
          $pendingEmployees = $this->database->connect()->query("SELECT employees.*, employee_details.resume_name,
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
         $formatted_date = date('M d Y, h:i A', strtotime($date));

         return $formatted_date;
    }

     public function acceptEmployee($employeeData){
        // prepared statement
         $stmt = $this->database->connect()->prepare("UPDATE employees AS e
                                                      INNER JOIN employee_details AS ed ON e.id = ed.employee_id
                                                      SET e.schedule_id = ?, e.status = ?, ed.salary = ?, ed.working_hours = ?, ed.department = ?, ed.date_hired = ?, ed.position = ?, ed.branch = ?
                                                      WHERE e.id = ?");

        //if execution fail
        if (!$stmt->execute([$employeeData['schedule'],
                            '1',
                             $employeeData['salary'],
                             $employeeData['workingHours'],
                             $employeeData['department'],
                             $this->date,
                             $employeeData['position'],
                             $employeeData['branch'],
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
        $stmt2 = $this->database->connect()->prepare($sql);
        $params = array_merge($values, array($employeeData['employeeId']));


         //if execution fail
        if (!$stmt2->execute($params)) {
            header("Location: ../Pages/employee-register.php?error=stmtfail");

            exit();
        }

        //generate employee account
        $employeeAccount = $this->generateEmployeeIDAndPassword($employeeData['employeeLastName']);

        //save account to database
        $this->saveEmployeeIDAndPassword($employeeAccount[0],$employeeAccount[1],$employeeData['employeeEmail'],$employeeData['employeeId']);

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

    public function saveEmployeeIDAndPassword($employeeUserID, $employeePassword,$employeeEmail,$employeeId){
        // prepare insert statement for employee_login table
         $sql = "INSERT INTO employee_login (login_id,login_password,employee_id) VALUES (?,?,?);";

         // prepared statement
         $stmt = $this->database->connect()->prepare($sql);

         //hash password
        $hashedpwd = password_hash($employeePassword, PASSWORD_DEFAULT);
         //if execution fail
        if (!$stmt->execute([$employeeUserID,$hashedpwd,$employeeId])) {
            header("Location: ../Pages/dashboard.php?error=stmtfail");
            exit();
        }

        //send email employee his/her id and password 
        $this->database->sendEmail($employeeEmail,"Congratulations! Your Job Application has been Accepted",
                                                  "User Id:".$employeeUserID ."\n Password: ".$employeePassword);

        //if success saving account 
        header("Location: ../Pages/dashboard.php?success=acceptEmployee");
        exit();
    }

    public function getAllEmployeePayslip() {
        $employeePayslip =  $this->database->connect()->query("SELECT id FROM employee_payslip")->fetchAll();
            return $employeePayslip;
            
            exit();
    }

    public function getEmployeePayslipTable($id) {
        $stmt = $this->database->connect()->prepare("SELECT * FROM employee_payslip_form WHERE payslip_id=?");

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
        $prlist =  $this->database->connect()->query("SELECT * FROM prlist")->fetchAll();
        return $prlist;
        exit();
}
public function payrollDetails($id){
    $prlist = $this->database->connect()->prepare("SELECT code, start, end, type FROM prlist WHERE id=?");
    $prlist->execute([$id]);
    return $prlist->fetchAll();
}

public function Insertpayroll($prlist){
    $sql = "INSERT INTO prlist (date, code, start, end, type)
       VALUES (?,?,?,?,?);";

   $stmt = $this->database->connect()->prepare($sql);
   if (!$stmt->execute([$this->date,
    $prlist['code'],
    $prlist['start'],
    $prlist['end'],
    $prlist['type']
    ])) {
    header("Location: ../admin/prlist.php?error=stmtfail");
       exit();
       }
}
public function updatePayroll($id, $code, $start, $end, $type){
    $stmt = $this->database->connect()->prepare("UPDATE prlist SET code = ?, start = ?, end = ?, type = ? WHERE id = ?");
    $stmt->bindParam(1, $code);
    $stmt->bindParam(2, $start);
    $stmt->bindParam(3, $end);
    $stmt->bindParam(4, $type);
    $stmt->bindParam(5, $id);
    $stmt->execute();
}
public function deletePayroll($id) {
    try {
        $sql = "DELETE FROM prlist WHERE id = :id";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
public function payslipList($prlistid){
    $stmt = $this->database->connect()->prepare("SELECT * FROM employee_payslip WHERE prlist_id=?");
    //if execution fail
    if (!$stmt->execute([$prlistid])) {
        header("Location: ../index.php?error=stmtfail");
        exit();
    }
    //fetch the employeeID
    $pslist = $stmt->fetchAll();
    return $pslist;
}
}

