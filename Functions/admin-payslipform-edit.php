<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $payslip = new Payroll($database);

    if (isset($_POST["submit-edit"])) {
        
        $prlistId = $_POST["prlist-id"];
        $employeeId = $_POST["employee-id"]; 
        $branch = $_POST['branch']; // employee_details
        $email = $_POST['email'];  // employeees  



     $payslip->updatePayslip($employeeId,$branch, $email);
     
      header("Location: ../admin/pslist.php?id=$prlistId&status=edited");
    }
} else {
    header("Location: ../admin/pslist.php?status=failEdit");
}
?>
