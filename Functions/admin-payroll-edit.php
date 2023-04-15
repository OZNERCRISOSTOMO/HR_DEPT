<?php
session_start();
if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $payroll = new Payroll($database);

    if (isset($_POST['editSubmit'])) {
        $id = $_POST['editId'];
        $code = $_POST['editCode'];
        $start = $_POST['editStart'];
        $end = $_POST['editEnd'];
        $type = $_POST['editType'];
    
        $update = $payroll->updatePayroll($id, $code, $start, $end, $type);
        if($update) {
            header("Location: ../admin/prlist.php");
        } else {
            echo "Failed to update payroll.";
        }
    }else if (isset($_POST['delete']) && isset($_POST['id'])) {
        // code for deleting payroll
        $id = $_POST['id'];
        $payroll->deletePayroll($id);
        header("Location: ../admin/prlist.php");
    } else {
        header("Location: ../admin/prlist.php");
    }
} else {
    header("Location: ../admin/prlist.php");
}
?>
