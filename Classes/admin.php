<?php

class Admin {

    private $database;

    public function __construct(Database $database) {
        $this->database = $database;
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

    public function getAdmin(){
        $admin = $this->database->connect()->query("SELECT * FROM hr_dept WHERE id = 1")->fetch();
        return $admin;
        exit();
    }

    public function getTotalEmployees(){
        $count = $this->database->connect()->query("SELECT count(*) FROM employees WHERE status = '1' ")->fetchColumn();

        return $count;
        exit();
    }

    public function getTotalPendingEmployees(){
        $count = $this->database->connect()->query("SELECT count(*) FROM employees WHERE status = '0' ")->fetchColumn();

        return $count;
        exit();
    }

    public function getEmployees(){
        $employees = $this->database->connect()->query("SELECT employees.*, employee_details.department,employee_details.date_applied FROM employees 
                                                        JOIN employee_details ON employees.id = employee_details.employee_id
                                                        WHERE employees.status = '1'")->fetchAll();

        return $employees;
        exit();
    }

    public function searchEmployees($name){
        $data =  $this->database->connect()->query("SELECT * FROM employees WHERE first_name LIKE '{$name}%' OR last_name LIKE '{$name}%' ")->fetchAll();
        return $data;
        exit();
    }

    public function getPendingEmployees(){
          $pendingEmployees = $this->database->connect()->query("SELECT employees.*, employee_details.resume_name,
                                                                                     employee_details.resume_path,
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
}

class Payroll{
    private $database;

    public function __construct(Database $database) {
        $this->database = $database;

    }
    public function payrollList(){
        $prlist =  $this->database->connect()->query("SELECT * FROM prlist")->fetchAll();
        return $prlist;
        exit();
}
}