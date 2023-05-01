<?php
session_start();
if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $payslip = new Payroll($database);

    if (isset($_POST['delete']) && $_POST['delete'] == 'Delete') {
        $id = $_POST['id'];

        echo $id;
        exit();
        $payslip->deletePayslipform($id);

    }
} else {
    header("Location: ../admin/pslist.php");
}
?>