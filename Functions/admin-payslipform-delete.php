<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $payslip = new Payroll($database);

    if (isset($_POST['delete']) && $_POST['delete'] == 'Delete') {
        $pslistId = $_POST['pslist-id'];
        $prlistId = $_POST["prlist-id"];
        $prlistType = $_POST["prslist-type"];

        $payslip->deletePayslipform($pslistId, $prlistId,$prlistType);

    }
} else {
    header("Location: ../admin/pslist.php");
}
?>