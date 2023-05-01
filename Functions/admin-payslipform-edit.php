<?php
session_start();
if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $payslip = new Payroll($database);

    if (isset($_POST['editbtn'])) {
        $employee_name = $_POST['employee-name'];
        $position = $_POST['position'];
        $branch = $_POST['branch'];
        $department = $_POST['department'];
        $from_date = $_POST['date-from'];
        $to_date = $_POST['date-to'];
        $number_present = $_POST['present'];
        $number_overtime = $_POST['overtime'];
        // $id = $_POST['editId'];
        // $code = $_POST['editCode'];
        // $start = $_POST['editStart'];
        // $end = $_POST['editEnd'];
        // $type = $_POST['editType'];

        echo $employee_name;
        echo $position;
        echo $branch;
        echo $department;
        echo $from_date;
        echo $to_date;
        echo $number_present;
        echo $number_overtime;
    
        $payslip->updatePayslip($id, $employee_name, $position, $branch, $department, $from_date, $to_date, $number_present, $number_overtime);
     
    }
} else {
    header("Location: ../admin/prlist.php");
}
?>
