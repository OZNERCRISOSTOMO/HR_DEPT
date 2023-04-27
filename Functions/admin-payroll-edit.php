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

        // echo $id;
        // echo $code;
        // echo $start;
        // echo $end;
        // echo $type;
    
        $payroll->updatePayroll($id, $code, $start, $end, $type);
     
    }
} else {
    header("Location: ../admin/prlist.php");
}
?>
