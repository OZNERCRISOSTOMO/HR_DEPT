<?php
session_start();
if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $payroll = new Payroll($database);

    if (isset($_POST['delete']) && $_POST['delete'] == 'Delete') {
        $id = $_POST['id'];
       
        $deleteMsg = $payroll->deletePayroll($id); // Call the deletePayroll method Payroll class passing the id to be deleted
        // header("Location: ../admin/prlist.php");
    }
} else {
    header("Location: ../admin/prlist.php");
}
?>